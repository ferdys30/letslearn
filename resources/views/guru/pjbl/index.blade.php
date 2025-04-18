<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Studi Kasus</h1>
        <p class="text-gray-600 mt-1">Project Based Learning Syntax 1</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Studi Kasus Kelompok</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Studi Kasus</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Kelompok</th>
                    <th>Studi Kasus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Studi Kasus</h3>

            <form action="#" method="POST" class="space-y-4">
                @csrf

                <!-- Input No Kelompok -->
                <div>
                    <label for="no_kelompok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Kelompok</label>
                    <input type="number" name="no_kelompok" id="no_kelompok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>
        
                <!-- Textarea Studi Kasus -->
                <div>
                    <label for="studi_kasus" class="block text-sm font-medium text-gray-700">Studi Kasus</label>
                    <textarea name="studi_kasus" id="studi_kasus" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tuliskan studi kasus di sini..."></textarea>
                </div>

                <!-- Aksi -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleModal(false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Kirim</button>
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
