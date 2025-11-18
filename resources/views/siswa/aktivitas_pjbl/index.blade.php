<x-navbar-siswa></x-navbar-siswa>

<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>

    <h1 class="text-xl font-bold mb-4">Pilih Pembelajaran {{ $mapel->nama_mapel }}</h1>

    <ul class="space-y-4">
        @forelse($siklus_pjbls as $siklus_pjbl)
            <li class="p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition-all duration-200 border-b-4 border-purple-600">
                <a href="{{ route('siswa.kelas.aktivitas_pjbl.kelompok_pjbl', [$mapel->slug, $siklus_pjbl->slug]) }}" class="block">
                    <div class="text-lg font-semibold text-purple-700 hover:underline">
                        {{ $siklus_pjbl->nama_siklus_pjbl }}
                    </div>

                    @if($siklus_pjbl->deskripsi)
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $siklus_pjbl->deskripsi }}
                        </p>
                    @endif

                    @if($siklus_pjbl->tanggal_mulai && $siklus_pjbl->tanggal_selesai)
                        <p class="text-xs text-gray-500 mt-2">
                            {{ \Carbon\Carbon::parse($siklus_pjbl->tanggal_mulai)->translatedFormat('d M Y') }} 
                            s.d. 
                            {{ \Carbon\Carbon::parse($siklus_pjbl->tanggal_selesai)->translatedFormat('d M Y') }}
                        </p>
                    @endif
                </a>
            </li>
        @empty
            <li class="text-gray-500">Belum ada siklus PJBL untuk mata pelajaran ini.</li>
        @endforelse
    </ul>
</x-layout-siswa>
