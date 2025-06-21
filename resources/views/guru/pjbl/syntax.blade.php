<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Syntax</h1>
        <p class="text-gray-600 mt-1">Project Based Learning</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Syntax Project Based Learning</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Syntax</button>
        </div>
    
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Urutan Syntax</th>
                    <th>Judul</th>
                    <th>Slug</th>
                    <th>Penjelasan</th>
                    <th>Waktu Pengerjaan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($syntax as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama_syntax }}</td>
                    <td>{{ $s->slug }}</td>
                    <td>{{ $s->penjelasan }}</td>
                    <td>{{ $s->waktu }}</td>
                    <td>
                        <a href="/guru/kuis/1" style="background-color: #006400; color: white; border: none;margin: 10px ; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative my-10 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Syntax</h3>
    
            <form action="/tambah/syntax" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
    
                <!-- Urutan Syntax -->
                <div>
                    <label for="urutan" class="block mb-2 text-sm font-medium text-gray-900">Urutan Syntax</label>
                    <input type="number" name="urutan" id="urutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>
    
                <!-- Judul Syntax -->
                <div>
                    <label for="nama_syntax" class="block mb-2 text-sm font-medium text-gray-900">Judul Syntax</label>
                    <input type="text" name="nama_syntax" id="nama_syntax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: HTML Dasar" required>
                </div>
    
                <!-- Slug Syntax -->
                <div>
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">Slug Syntax</label>
                    <input type="text" name="slug" id="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: html-dasar" required>
                </div>
    
                <!-- Penjelasan Syntax -->
                <div>
                    <label for="penjelasan" class="block mb-2 text-sm font-medium text-gray-900">Penjelasan Syntax</label>
                    <textarea name="penjelasan" id="penjelasan" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Masukkan penjelasan singkat tentang syntax..." required></textarea>
                </div>
    
                <!-- Pengumpulan -->
                <div>
                    <label for="pengumpulan" class="block mb-2 text-sm font-medium text-gray-900">Pengumpulan</label>
                    <select name="pengumpulan" id="pengumpulan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                        <option value="1">Text Field</option>
                        <option value="2">File Input</option>
                        <option value="">None</option>
                    </select>
                </div>
    
                <!-- Waktu Mulai -->
                <div>
                    <label for="waktu_mulai" class="block mb-2 text-sm font-medium text-gray-900">Waktu Pengerjaan</label>
                    <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5"
                        required>
                </div>


                <!-- Waktu Upload -->
                <div>
                    <label for="waktu" class="block mb-2 text-sm font-medium text-gray-900">Waktu Pengerjaan</label>
                    <input type="text" name="waktu" id="waktu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
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
    
    


    <!-- JS -->
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
</x-layout-guru>
