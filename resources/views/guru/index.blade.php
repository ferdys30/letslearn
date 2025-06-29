<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Pak Adi 👋</h1>
        <p class="text-gray-600 mt-1">Senang melihat Anda kembali! Silakan pilih kelas atau lihat data yang tersedia.</p>
    </section>

    {{-- Cek jika ada flash message untuk alert --}}
    {{-- @if (session('pengumpulan_alert'))
        <div class="mt-2 mb-2 p-4 rounded-md bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800">
            <strong class="font-semibold">Perhatian!</strong> {{ session('pengumpulan_alert') }}
        </div>
    @endif

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
    </section> --}}

    
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
      <h2 class="text-3xl font-bold text-gray-800 text-left">Kelas Saya</h2>
      {{-- <p class="text-gray-600 text-left mt-2">Pilih kelas yang ingin kamu pelajari!</p> --}}
      <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($mapelList as $mapel)
                <!-- Card Pemrograman Web -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $mapel->nama_mapel }}</h3>
                    <p class="text-gray-600 mt-2">{{ $mapel->deskripsi_mapel }}</p>
                    <a href="{{ route('guru.mapel', $mapel->slug) }}" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                        Lihat Kelas
                    </a>
                </div>
                @endforeach
            </div>
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
