<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Materi</h1>
        <p class="text-gray-600 mt-1">Pemrograman Website</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Materi Pemrograman Website</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Materi</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Urutan Materi</th>
                    <th>Deskripsi Materi</th>
                    <th>Dokumen Materi (PDF/Word)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materi as $m)
                    <tr>
                        <td>1</td>
                        <td>HTML Dasar</td>
                        <td>html_dasar.pdf</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Materi</h3>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Input Urutan Materi -->
                <div>
                    <label for="urutan_materi" class="block mb-2 text-sm font-medium text-gray-900">Urutan Materi</label>
                    <input type="number" name="urutan_materi" id="urutan_materi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>

                <!-- Textarea Deskripsi Materi -->
                <div>
                    <label for="deskripsi_materi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Materi</label>
                    <textarea name="deskripsi_materi" id="deskripsi_materi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: Pengenalan HTML, CSS Flexbox, dll" required></textarea>
                </div>

                <!-- Upload Dokumen -->
                <div>
                    <label for="dokumen_materi" class="block mb-2 text-sm font-medium text-gray-900">Upload Dokumen (PDF/Word)</label>
                    <input type="file" name="dokumen_materi" id="dokumen_materi" accept=".pdf,.doc,.docx" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
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
