<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <h1 class="text-xl font-bold mb-4">Pilih Penugasan</h1>
    <ul class="space-y-2">
        @foreach($penugasans as $penugasan)
            <li class="p-4 bg-white shadow rounded">
                <a href="{{ route('siswa.kelas.pjbl.kelompok', [$mapel->slug, $penugasan->slug]) }}" class="text-blue-600 hover:underline">
                    {{ $penugasan->nama_penugasan }}
                </a>
            </li>
        @endforeach
    </ul>

</x-layout>
