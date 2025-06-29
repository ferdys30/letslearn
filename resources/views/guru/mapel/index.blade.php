<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    {{-- Cek jika ada flash message untuk alert --}}
    @if (session('pengumpulan_alert'))
        <div class="mt-2 mb-2 p-4 rounded-md bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800">
            <strong class="font-semibold">Perhatian!</strong> {{ session('pengumpulan_alert') }}
            @php
                session()->forget('pengumpulan_alert');
            @endphp
        </div>
    @endif

         
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 w-full">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Pengaturan Mata Pelajaran</h2>
        <h3 class="text-2xl text-purple-700 font-semibold">{{ $mapel->nama_mapel }}</h3>
        <p class="text-gray-600 mb-8">{{ $mapel->deskripsi_mapel }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('guru.mapel.detail', $mapel->slug) }}"
            class="bg-purple-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-purple-700 transition flex items-center justify-center">
                📋 Detail Pelajaran
            </a>
            {{-- <a href="{{ route('guru.pjbl.studi_kasus', $mapel->slug) }}"
            class="bg-blue-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-blue-700 transition flex items-center justify-center">
                🧩 Studi Kasus
            </a> --}}
            {{-- <a href="{{ route('guru.pjbl.syntax', $mapel->slug) }}"
            class="bg-green-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-green-700 transition flex items-center justify-center">
                🔣 Syntax
            </a> --}}
            <a href="{{ route('guru.materi', $mapel->slug) }}"
            class="bg-yellow-500 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-yellow-600 transition flex items-center justify-center">
                📖 Materi
            </a>
            <a href="{{ route('guru.kuis', $mapel->slug) }}"
            class="bg-red-500 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-red-600 transition flex items-center justify-center">
                📝 Kuis
            </a>
            {{-- <a href="{{ route('guru.pjbl.kelompok', $mapel->slug) }}"
            class="bg-indigo-500 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-indigo-600 transition flex items-center justify-center">
                👥 Kelompok --}}
            </a>
        </div>
    </section>




    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left">Data Kelompok</h2>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Kelompok</th>
                    <th>Studi Kasus Yang Didapatkan</th>
                    <th>Anggota</th>
                    <th>Progres Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($kelompok as $klmpk)
                    <tr>
                        <td>{{ $klmpk->nama_kelompok }}</td>
                        <td>
                            <ol>
                                @foreach ($studi_kasus->where('id_kelompok', $klmpk->id) as $item)
                                    <li>{{ $loop->iteration }}. {{ $item->studi_kasus }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>
                            <ol>
                                @foreach ($anggota->where('id_kelompok', $klmpk->id) as $item)
                                    <li>{{ $loop->iteration }}. {{ $item->user->nama }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>
                            <div class="relative pt-1">
                                <a href="/guru/pjbl/kelompok/{{ $klmpk->nama_kelompok }}">
                                    <div class="flex mb-2 items-center justify-between">
                                        <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                                        <span class="text-xs font-semibold inline-block py-1 uppercase">
                                            {{ $klmpk->progress }}%
                                        </span>
                                    </div>
                                </a>
                                <div class="flex mb-2">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $klmpk->progress }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


    <!-- JS jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
