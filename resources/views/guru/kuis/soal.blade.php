<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Soal</h1>
        <p class="text-gray-600 mt-1">Pemrograman Website</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Soal Kuis HTML Dasar</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Soal</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Urutan Soal</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban Benar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Apa itu tag &lt;html&gt;?</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Untuk apa tag &lt;head&gt; digunakan?</td>
                    <td>B</td>
                </tr>
            </tbody>
        </table>
    </section>


    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="relative w-full max-w-md my-10">
            <div class="bg-white rounded-lg shadow-lg max-h-[90vh] overflow-y-auto p-6 relative">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Soal</h3>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Urutan Soal -->
                    <div>
                        <label for="urutan_soal" class="block mb-2 text-sm font-medium text-gray-900">Urutan Soal</label>
                        <input type="number" name="urutan_soal" id="urutan_soal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                    </div>

                    <!-- Pertanyaan -->
                    <div>
                        <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: Apa itu HTML?" required></textarea>
                    </div>

                    <!-- Jawaban A -->
                    <div>
                        <label for="jawaban_a" class="block mb-2 text-sm font-medium text-gray-900">Jawaban A</label>
                        <input type="text" name="jawaban_a" id="jawaban_a" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Isi jawaban A" required>
                    </div>

                    <!-- Jawaban B -->
                    <div>
                        <label for="jawaban_b" class="block mb-2 text-sm font-medium text-gray-900">Jawaban B</label>
                        <input type="text" name="jawaban_b" id="jawaban_b" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Isi jawaban B" required>
                    </div>

                    <!-- Jawaban C -->
                    <div>
                        <label for="jawaban_c" class="block mb-2 text-sm font-medium text-gray-900">Jawaban C</label>
                        <input type="text" name="jawaban_c" id="jawaban_c" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Isi jawaban C" required>
                    </div>

                    <!-- Jawaban D -->
                    <div>
                        <label for="jawaban_d" class="block mb-2 text-sm font-medium text-gray-900">Jawaban D</label>
                        <input type="text" name="jawaban_d" id="jawaban_d" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Isi jawaban D" required>
                    </div>

                    <!-- Jawaban Benar -->
                    <div>
                        <label for="jawaban_benar" class="block mb-2 text-sm font-medium text-gray-900">Jawaban Benar</label>
                        <select name="jawaban_benar" id="jawaban_benar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="">Pilih jawaban benar</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
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
