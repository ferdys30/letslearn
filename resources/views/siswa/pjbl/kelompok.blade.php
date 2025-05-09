<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <section class="container mx-auto px-6 lg:px-10 py-6">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between">
            <!-- Teks -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-4xl font-bold text-gray-800 leading-tight">
                    Kelas <span class="text-purple-600">{{ $mapel->nama_mapel }}</span>
                </h1>
                <p class="mt-4 text-gray-600">
                    {{ $mapel->deskripsi_mapel }}
                </p>
            </div>
            <!-- Gambar -->
            <div class="lg:w-1/2 flex justify-center lg:justify-end mt-8 lg:mt-0">
                <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-3/4 max-w-xs">
            </div>
        </div>
    </section>


    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Kelompok Pelajaran {{ $mapel->nama_mapel }}</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Kelompok</button>
        </div>
        <table id="myTable" class="display w-full table-auto text-sm">
            <thead class="bg-gray-200">
                <tr>
                    {{-- <th class="px-4 py-2 text-left font-semibold text-gray-800">Urutan Kelompok</th> --}}
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Nama Kelompok</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Maksimal Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Nama Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Jumlah Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Opsi</th>
                </tr>
            </thead>
            
            <tbody class="bg-white">
                @foreach ($kelompok as $klmpk)
                @php
                    $anggotaCount = $anggota->where('id_kelompok', $klmpk->id)->count();
                    $total = $klmpk->jumlah_kelompok;
                    $percentage = $total > 0 ? round(($anggotaCount / $total) * 100) : 0;
                    $progressColor = $percentage >= 100 ? 'bg-green-600' : 'bg-blue-600';
                @endphp
                <tr class="border-t hover:bg-gray-50">
                    {{-- <td class="px-4 py-2">1</td> --}}
                    <td class="px-4 py-2">{{ $klmpk->nama_kelompok }}</td>
                    <td class="px-4 py-2">{{ $klmpk->jumlah_kelompok }}</td>
                    <td>
                        <ol>
                            @foreach ($anggota->where('id_kelompok', $klmpk->id) as $item)
                                <li>{{ $loop->iteration }}. {{ $item->user->name }}</li>
                            @endforeach
                        </ol>
                    </td>   
                    <td class="px-4 py-2">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <span class="text-xs font-semibold inline-block py-1 uppercase">Jumlah</span>
                                <span class="text-xs font-semibold inline-block py-1 uppercase">
                                    {{ $anggotaCount }}/{{ $total }}
                                </span>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="{{ $progressColor }} h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        @if ($anggotaCount >= $klmpk->jumlah_kelompok)
                            <a href="/siswa/pjbl" class="text-green-600 hover:text-green-800 hover:underline">
                                Lihat
                            </a>
                        @endif
                    </td>                    
                </tr>
                @endforeach

{{--         
                <!-- Row 2 -->
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2">SecondClass</td>
                    <td class="px-4 py-2">3</td>
                    <td>
                        <ol>
                          <li>1. saya</li>
                          <li>2. kamu</li>
                        </ol>
                    </td>   
                    <td class="px-4 py-2">
                        <a href="/guru/kuis/1" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                            Masuk Kelas
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/siswa/pjbl" class="text-green-600 hover:text-green-800 hover:underline">
                            Lihat
                        </a>
                    </td>
                </tr>
        
                <!-- Row 3 -->
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">3</td>
                    <td class="px-4 py-2">ThirdTeam</td>
                    <td class="px-4 py-2">3</td>
                    <td>
                        <ol>
                          <li>1. saya</li>
                          <li>2. kamu</li>
                        </ol>
                    </td>   
                    <td class="px-4 py-2">
                        <a href="/guru/kuis/1" class="bg-gray-400 text-white px-4 py-2 rounded-md cursor-not-allowed" disabled>
                            Masuk Kelas
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/siswa/pjbl" class="text-green-600 hover:text-green-800 hover:underline">
                            Lihat
                        </a>
                    </td>
                </tr> --}}
            </tbody>
        </table>
        
    </div>
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Syntax</h3>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Urutan Syntax -->
                <div>
                    <label for="urutan_syntax" class="block mb-2 text-sm font-medium text-gray-900">Urutan Syntax</label>
                    <input type="number" name="urutan_syntax" id="urutan_syntax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>

                <!-- Judul Syntax -->
                <div>
                    <label for="judul_syntax" class="block mb-2 text-sm font-medium text-gray-900">Judul Syntax</label>
                    <input type="text" name="judul_syntax" id="judul_syntax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: HTML Dasar" required>
                </div>

                <!-- Slug Syntax -->
                <div>
                    <label for="slug_syntax" class="block mb-2 text-sm font-medium text-gray-900">Slug Syntax</label>
                    <input type="text" name="slug_syntax" id="slug_syntax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: html-dasar" required>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleModal(false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                </div>
            </form>

            <!-- Tombol Close -->
            <button onclick="toggleModal(false)" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        function toggleModal(show) {
            const modal = document.getElementById('modalForm');
            modal.classList.toggle('hidden', !show);
        }
    </script>
</x-layout-siswa>
