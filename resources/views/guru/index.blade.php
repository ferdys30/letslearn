<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    @role('guru')
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Pak {{ Auth::user()->nama }}</h1>
        <p class="text-gray-600 mt-1">Senang melihat Anda kembali! Silakan pilih kelas atau lihat data yang tersedia.</p>
    </section>
    @endrole
    
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
    @role('admin')
        <h2 class="text-3xl font-bold text-gray-800 text-left mb-4">Halaman Admin</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Mata Pelajaran --}}
            <a href="{{ route('admin.mapel') }}" class="block p-5 bg-blue-100 rounded-lg shadow hover:bg-blue-200 transition">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Mata Pelajaran</h3>
                <p class="text-sm text-blue-700">Kelola daftar mapel dan guru pengampu.</p>
            </a>

            {{-- Data Guru --}}
            <a href="{{ route('admin.guru') }}" class="block p-5 bg-green-100 rounded-lg shadow hover:bg-green-200 transition">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Data Guru</h3>
                <p class="text-sm text-green-700">Lihat dan kelola informasi guru.</p>
            </a>

            {{-- Data Siswa --}}
            <a href="{{ route('admin.siswa') }}" class="block p-5 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200 transition">
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">Data Siswa</h3>
                <p class="text-sm text-yellow-700">Kelola siswa per kelas dan informasi lainnya.</p>
            </a>

            {{-- Kelas --}}
            <a href="{{ route('admin.kelas') }}" class="block p-5 bg-purple-100 rounded-lg shadow hover:bg-purple-200 transition">
                <h3 class="text-lg font-semibold text-purple-800 mb-2">Kelas</h3>
                <p class="text-sm text-purple-700">Manajemen kelas dan struktur pembelajaran.</p>
            </a>
        </div>
    @endrole
    @role('guru')
    <h2 class="text-3xl font-bold text-gray-800 text-left">Kelas Saya</h2>
      {{-- <p class="text-gray-600 text-left mt-2">Pilih kelas yang ingin kamu pelajari!</p> --}}
        @if($mapelList->isEmpty())
            <div class="text-gray-600 text-center py-4">
                Belum ada mata pelajaran yang ditambahkan.
            </div>
        @else
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($mapelList as $mapel)
                    <!-- Card Mata Pelajaran -->
                    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center border-b-4 border-purple-600">
                        <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $mapel->nama_mapel }}</h3>
                        <p class="text-gray-600 mt-2">{{ $mapel->deskripsi_mapel }}</p>
                        <a href="{{ route('guru.mapel', $mapel->slug) }}" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                            Lihat Kelas
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endrole
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
