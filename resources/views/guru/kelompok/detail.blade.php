<x-navbar-guru></x-navbar-guru>
<x-layout-guru>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 py-6">
        @foreach ($anggotaKelompok as $anggota)
            <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
                <img src="https://i.pravatar.cc/60?img={{ $loop->iteration }}" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
                <div>
                    <h3 class="text-md font-semibold text-gray-800">{{ $anggota->user->nama }}</h3>
                    <p class="text-sm text-gray-500">NIS: {{ $anggota->user->nis ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </section>
    
  <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800">Project Based Learning Mata Pelajaran <span class="text-purple-600">Pemrograman Website</span></h1>

    <div class="flex mt-6" x-data="{ tab: null }">
        <!-- Sidebar Navigasi -->
        <div class="w-1/4 space-y-2">
            @foreach ($pjbls as $pjbl)
                <button 
                    @click="tab = '{{ $pjbl->slug }}'" 
                    :class="{ 'bg-purple-600 text-white': tab === '{{ $pjbl->slug }}' }"
                    class="block w-full text-left px-4 py-3 rounded-lg 
                        {{ $pjbl->terkunci ? 'bg-gray-300 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-purple-700 hover:text-white transition' }}"
                    {{ $pjbl->terkunci ? 'disabled' : '' }}>
                    {{ $pjbl->nama_syntax }}
                </button>
            @endforeach
        </div>

    <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
        @foreach ($pjbls as $pjbl)
            <div x-show="tab === '{{ $pjbl->slug }}'">
                @if ($pjbl->terkunci)
                    <p class="text-red-500 font-semibold">Konten ini belum bisa diakses. Menunggu validasi guru atau belum waktunya dibuka.</p>
                @else
                    <h2 class="text-xl font-semibold text-gray-700">{{ $pjbl->nama_syntax }}</h2>
                    <p class="mt-2 text-gray-600">{{ $pjbl->penjelasan }}</p>
                    @php
                        $jawaban = $pengumpulans[$pjbl->id] ?? null;
                    @endphp

                    @if ($pjbl->pengumpulan == 1 && $jawaban)
                        {{-- Deskriptif (Teks) --}}
                        <div class="mt-4">
                            <h4 class="text-md font-semibold text-gray-700">Jawaban Deskriptif:</h4>
                            <p class="text-gray-600 mt-1">{{ $jawaban->deskriptif ?? 'Belum ada jawaban.' }}</p>
                        </div>
                    @elseif ($pjbl->pengumpulan == 2 && $jawaban)
                        {{-- File --}}
                        <div class="mt-4">
                            <h4 class="text-md font-semibold text-gray-700">File Jawaban:</h4>
                            @if ($jawaban->file_pengumpulan)
                                <a href="{{ asset('storage/' . $jawaban->file_pengumpulan) }}" 
                                class="text-blue-600 underline" target="_blank">
                                    Lihat File
                                </a>
                            @else
                                <p class="text-gray-500">Belum ada file yang dikumpulkan.</p>
                            @endif
                        </div>
                    @elseif ($pjbl->pengumpulan == 3)
                        {{-- Tidak perlu menampilkan apa pun --}}
                    @else
                        <p class="text-gray-400 italic mt-2">Belum ada pengumpulan dari siswa.</p>
                    @endif


                    <div class="mt-4 flex justify-between items-center">
                        <!-- Tanggal -->
                        <span class="text-sm text-gray-500">
                            Dibuka pada: {{ \Carbon\Carbon::parse($pjbl->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>

                    <!-- Status Validasi -->
                    @if ($jawaban)
                        <div class="mt-2 flex justify-between items-center">
                            <p class="text-sm font-medium text-{{ $jawaban->status == '2' ? 'green' : 'yellow' }}-600">
                                Status: 
                                @if ($jawaban->status == '2')
                                    Sudah divalidasi
                                @elseif ($jawaban->status == '1')
                                    Menunggu validasi
                                @else
                                    Belum dikumpulkan
                                @endif
                            </p>

                            @if ($jawaban->status != '2')
                                <form action="/guru/pjbl/validasi/{{ $jawaban->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                        class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Validasi</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                    @endif


                @endif

            </div>
        @endforeach
    </div>

    </div>
  </div>
</x-layout-guru>
