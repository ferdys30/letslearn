<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
  <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 py-6">
        @foreach ($anggota_kelompok as $anggota)
            <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
                <img src="https://i.pravatar.cc/60?img={{ $loop->iteration }}" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
                <div>
                    <h3 class="text-md font-semibold text-gray-800">{{ $anggota->user->nama }}</h3>
                    <p class="text-sm text-gray-400"><strong>Posisi: {{ $anggota->posisi->nama_posisi ?? 'Tidak Ada' }}</strong></p>
                </div>
            </div>
        @endforeach
    </section>
    
  <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800">Project Based Learning Mata Pelajaran <span class="text-purple-600">Pemrograman Website</span></h1>

    <div class="flex mt-6" x-data="{ tab: '{{ $aktivitas_pjbls->first()?->slug }}' }">
        <!-- Sidebar Navigasi -->
        @php
    $grouped = $aktivitas_pjbls->groupBy(fn($aktivitas_pjbl) => optional($aktivitas_pjbl->pertemuan)->judul_pertemuan ?? 'Tanpa Pertemuan');
@endphp

    <div class="w-1/4 space-y-4">
        @foreach ($grouped as $judulPertemuan => $aktivitas_pjblGroup)
            <div class="space-y-2">
                <h2 class="text-lg font-semibold text-gray-700">
                    {{ $judulPertemuan }}
                    @php
                        $tanggal = $aktivitas_pjblGroup->first()->pertemuan->tanggal ?? null;
                    @endphp
                    @if ($tanggal)
                        <span class="text-sm text-gray-500 ml-2">
                            ({{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }})
                        </span>
                    @endif
                </h2>

                @foreach ($aktivitas_pjblGroup as $aktivitas_pjbl)
                    <button 
                        @click="tab = '{{ $aktivitas_pjbl->slug }}'" 
                        :class="{ 'bg-purple-600 text-white': tab === '{{ $aktivitas_pjbl->slug }}' }"
                        class="block w-full text-left px-4 py-3 rounded-lg 
                            {{ $aktivitas_pjbl->terkunci ? 'bg-gray-300 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-purple-700 hover:text-white transition' }}"
                        {{ $aktivitas_pjbl->terkunci ? 'disabled' : '' }}>
                        {{ $aktivitas_pjbl->nama_syntax }}
                    </button>
                @endforeach
            </div>
        @endforeach
    </div>


    <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
        @foreach ($aktivitas_pjbls as $aktivitas_pjbl)
            <div x-show="tab === '{{ $aktivitas_pjbl->slug }}'">
                @if ($aktivitas_pjbl->terkunci)
                    <p class="text-red-500 font-semibold">Konten ini belum bisa diakses. Menunggu validasi guru atau belum waktunya dibuka.</p>
                @else
                    <h2 class="text-xl font-semibold text-gray-700">{{ $aktivitas_pjbl->nama_syntax }}</h2>
                    <p class="mt-2 text-gray-600">{{ $aktivitas_pjbl->penjelasan }}</p>

                    <div class="mt-4 flex justify-between items-center">
                        <!-- Tanggal -->
                        <span class="text-sm text-gray-500">
                            Dibuka pada: {{ \Carbon\Carbon::parse($aktivitas_pjbl->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                        </span>

                        <!-- Tombol Lihat -->
                        @if (!isset($pengumpulan_tugass[$aktivitas_pjbl->id]))
                            <a href="{{ route('siswa.kelas.aktivitas_pjbl.syntax', ['mapel' => $mapel->slug,'siklus_pjbl' => $siklus_pjbl->slug, 'aktivitas_pjbl' => $aktivitas_pjbl->slug]) }}"
                            class="bg-purple-600 text-white text-sm px-4 py-2 rounded hover:bg-purple-700 transition">
                                Lihat
                            </a>
                        @endif
                    </div>

                    <!-- Status Validasi -->
                    @php
                        $pengumpulan_tugas = $pengumpulan_tugass[$aktivitas_pjbl->id] ?? null;
                        $statusText = match($pengumpulan_tugas->status ?? null) {
                            '1' => 'Belum divalidasi',
                            '2' => 'Sudah divalidasi',
                            default => 'Belum ada pengumpulan_tugas',
                        };
                    @endphp
                    <p class="mt-2 text-sm text-{{ $pengumpulan_tugas?->status === '2' ? 'green' : 'yellow' }}-600 font-medium">
                        Status Validasi: {{ $statusText }}
                    </p>
                @endif

            </div>
        @endforeach
    </div>

    </div>
  </div>
</x-layout-siswa>
