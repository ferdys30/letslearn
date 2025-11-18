<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Kuis</h1>
        <p class="text-gray-600 mt-1">Pemrograman Website</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Kuis Pemrograman Website</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Kuis</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Urutan Kuis</th>
                    <th>Judul Kuis</th>
                    <th>Deskripsi Materi</th>
                    <th>Durasi</th>
                    <th>Soal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftar_kuis as $kuis)
                    <tr>
                        <td>{{ $kuis->urutan_kuis }}</td>
                        <td>{{ $kuis->judul }}</td>
                        <td>{{ $kuis->deskripsi_kuis }}</td>
                        <td>{{ $kuis->waktu_pengerjaan }}</td>
                        <td>
                            <a href="{{ route('guru.soal', ['kuis' => $kuis,'mapel'=>$mapel]) }}"
                            style="background-color: #006400; color: white; border: none;margin: 10px ; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                                Soal
                            </a>
                            <button 
                                onclick='editKuis(@json($kuis))'
                                style="background-color: #6A0DAD; color: white; border: none; margin: 10px; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Kuis</h3>

            <form action="{{ route('guru.kuis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_mapel" value="1">

                <!-- Urutan Kuis -->
                <div>
                    <label for="urutan_kuis" class="block mb-2 text-sm font-medium text-gray-900">Urutan Kuis</label>
                    <input type="number" name="urutan_kuis" id="urutan_kuis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>

                <!-- Judul Kuis -->
                <div>
                    <label for="judul_kuis" class="block mb-2 text-sm font-medium text-gray-900">Judul Kuis</label>
                    <input type="text" name="judul_kuis" id="judul_kuis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: HTML Dasar" required>
                </div>

                <!-- Deskripsi Materi -->
                <div>
                    <label for="deskripsi_materi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Materi</label>
                    <textarea name="deskripsi_materi" id="deskripsi_materi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: Materi mengenai struktur dasar HTML..." required></textarea>
                </div>

                <!-- Durasi -->
                <div>
                    <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900">Durasi (menit)</label>
                    <input type="number" name="durasi" id="durasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 30" required>
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

    <div id="modalEditKuis" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">Edit Kuis</h3>
            <form method="POST" id="formEditKuis" action="">
                @csrf
                @method('PUT')

                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Urutan Kuis</label>
                    <input type="text" name="urutan_kuis" id="editUrutanKuis" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul</label>
                    <input type="text" name="judul" id="editJudulKuis" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="deskripsi_kuis" id="editDeskripsiKuis" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Waktu Pengerjaan</label>
                    <input type="text" name="waktu_pengerjaan" id="editWaktuKuis" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('modalEditKuis').classList.add('hidden')"
                            class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
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
    <script>
        const routeEditKuis = `{{ route('guru.kuis.update', ':id') }}`; // gunakan placeholder

        function editKuis(kuis) {
            const form = document.getElementById('formEditKuis');
            form.action = routeEditKuis.replace(':id', kuis.id); // ganti :id dengan kuis.id

            document.getElementById('editUrutanKuis').value = kuis.urutan_kuis;
            document.getElementById('editJudulKuis').value = kuis.judul;
            document.getElementById('editDeskripsiKuis').value = kuis.deskripsi_kuis;
            document.getElementById('editWaktuKuis').value = kuis.waktu_pengerjaan;

            document.getElementById('modalEditKuis').classList.remove('hidden');
        }
    </script>

</x-layout-guru>
