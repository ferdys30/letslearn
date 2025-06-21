<x-navbar-siswa/>
<x-layout-siswa>
    <x-slot:tittle>Kuis</x-slot:tittle>

    <div x-data="{ tab: '{{ $kuisList->first()?->id ?? '' }}' }" class="flex gap-6 mt-6">
        <!-- Sidebar Navigasi Kuis -->
        <div class="w-1/4 space-y-2">
            @foreach ($kuisList as $kuis)
                <button 
                    @click="if (!{{ $kuis->terkunci ? 'true' : 'false' }}) tab = '{{ $kuis->id }}'" 
                    :class="bg-purple-600 text-white"': tab === '{{ $kuis->id }}' }"
                    class="block w-full text-left px-4 py-3 rounded-lg
                        {{ $kuis->terkunci ? 'bg-gray-300 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-purple-700 hover:text-white transition' }}"
                    {{ $kuis->terkunci ? 'disabled' : '' }}">
                    {{ $kuis->judul }}
                </button>
            @endforeach
        </div>

        <!-- Konten Kuis -->
        <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
            @foreach ($kuisList as $kuis)
                <div x-show="tab === '{{ $kuis->id }}'">
                    @if ($kuis->terkunci)
                        <p class="text-red-500 font-semibold">Kuis ini belum tersedia. Silakan tunggu jadwal atau validasi dari guru.</p>
                    @else
                        <h2 class="text-2xl font-bold text-gray-800">{{ $kuis->judul }}</h2>
                        <p class="mt-2 text-gray-600">{{ $kuis->deskripsi_kuis }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                Durasi: {{ $kuis->waktu_pengerjaan }} menit
                            </span>

                            <a href="{{ route('siswa.kuis.show', $kuis->id) }}"
                               class="bg-purple-600 text-white text-sm px-4 py-2 rounded hover:bg-purple-700 transition">
                                Mulai Kuis
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-layout-siswa>
