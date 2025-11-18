<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <!-- STARTHERO -->

    <h2 class="text-2xl font-bold mb-6 text-center">Pilih Kelas</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($mapelList as $mapel)
            @php
                if ($fitur === 'materi') {
                    $url = route('siswa.kelas.materi', ['mapel' => $mapel->slug]);
                } elseif ($fitur === 'kuis') {
                    $url = route('siswa.kelas.kuis', ['mapel' => $mapel->slug]);
                } elseif ($fitur === 'aktivitas_pjbl') {
                    $url = route('siswa.kelas.siklus_pjbl', ['mapel' => $mapel->slug]);
                } else {
                    $url = '#'; // fallback atau default
                }
            @endphp

            <a href="{{ $url }}"
                class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition text-center border-b-4 border-purple-600">
                <h3 class="text-xl font-semibold text-gray-800">{{ $mapel->nama_mapel }}</h3>
                <p class="text-gray-600 mt-2">{{ $mapel->deskripsi_mapel }}</p>
            </a>
        @endforeach

    </div>



</x-layout>