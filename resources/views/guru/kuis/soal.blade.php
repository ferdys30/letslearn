<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
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
                    <th>Gambar</th>
                    <th>Jawaban Benar</th>
                    <th>Point</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kuis->soals as $soal)
                    <tr>
                        <td>{{ $soal->urutan }}</td>
                        <td>{{ Str::limit($soal->pertanyaan, 100) }}</td>
                        <td>
                            @if($soal->gambar)
                                <img src="{{ asset('storage/' . $soal->gambar) }}" class="w-16 rounded">
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ strtoupper($soal->jawaban_benar) }}</td>
                        <td>{{ $soal->point }}</td>
                        <td class="flex gap-2">
                            <!-- Tombol Edit -->
                            <button type="button" onclick='editSoal(@json($soal))'
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('guru.soal.delete', $soal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>


    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="relative w-full max-w-3xl my-10"> <!-- Ganti max-w-md → max-w-3xl -->
            <div class="bg-white rounded-lg shadow-lg max-h-[90vh] overflow-y-auto p-8 relative"> <!-- padding lebih besar -->
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Soal</h3>

                <form action="{{ route('guru.soal.store', $kuis->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_kuis" value="{{ $kuis->id }}">

                    <!-- Urutan Soal -->
                    <div class="mb-3">
                        <label for="urutan_soal" class="block mb-2 text-sm font-medium text-gray-900">Urutan Soal</label>
                        <input type="number" name="urutan_soal" id="urutan_soal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900">Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="gambar" 
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            accept="image/*">
                    </div>
                    <!-- Pertanyaan -->
                    <div class="mb-3">
                        <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: Apa itu HTML?" required></textarea>
                    </div>
                    <!-- Jawaban A–E -->
                    @foreach(['a','b','c','d','e'] as $option)
                    <div class="mb-3">
                        <label for="jawaban_{{ $option }}" class="block mb-2 text-sm font-medium text-gray-900">Jawaban {{ strtoupper($option) }}</label>
                        <textarea name="jawaban_{{ $option }}" id="jawaban_{{ $option }}" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Isi jawaban {{ strtoupper($option) }} (bisa berupa kode)" required></textarea>
                    </div>
                    @endforeach

                    <!-- Jawaban Benar -->
                    <div class="mb-3">
                        <label for="jawaban_benar" class="block mb-2 text-sm font-medium text-gray-900">Jawaban Benar</label>
                        <select name="jawaban_benar" id="jawaban_benar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="">Pilih jawaban benar</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>
                    <!-- Point -->
                    <div class="mb-3">
                        <label for="point" class="block mb-2 text-sm font-medium text-gray-900">Poin</label>
                        <input type="number" name="point" id="point" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 10" required>
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

    <div id="modalEditSoal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="relative w-full max-w-3xl my-10"> <!-- Ganti max-w-md → max-w-3xl -->
            <div class="bg-white rounded-lg shadow-lg max-h-[90vh] overflow-y-auto p-8 relative">
                <h3 class="text-lg font-semibold mb-4">Edit Soal</h3>
                <form id="formEditSoal" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Urutan</label>
                        <input type="text" name="urutan_soal" id="editUrutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="pertanyaan" id="editPertanyaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="editGambar" 
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            accept="image/*">
                        
                        <!-- Preview gambar lama -->
                        <div id="previewGambar" class="mt-2">
                            <img src="" alt="Preview" class="w-32 rounded hidden">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban A</label>
                        <input type="text" name="jawaban_a" id="editA" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban B</label>
                        <input type="text" name="jawaban_b" id="editB" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban C</label>
                        <input type="text" name="jawaban_c" id="editC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban D</label>
                        <input type="text" name="jawaban_d" id="editD" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban E</label>
                        <input type="text" name="jawaban_e" id="editE" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jawaban Benar</label>
                        <select name="jawaban_benar" id="editBenar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Poin</label>
                        <input type="number" name="point" id="editPoint" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modalEditSoal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
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
    <script>
        const routeUpdateSoal = @json(route('guru.soal.update', ':id'));
        function editSoal(soal) {
            // Set form action
            const form = document.getElementById('formEditSoal');
            form.action = routeUpdateSoal.replace(':id', soal.id);

            // Isi form dengan data soal
            document.getElementById('editUrutan').value = soal.urutan;
            document.getElementById('editPertanyaan').value = soal.pertanyaan;
            document.getElementById('editA').value = soal.jawaban_a;
            document.getElementById('editB').value = soal.jawaban_b;
            document.getElementById('editC').value = soal.jawaban_c;
            document.getElementById('editD').value = soal.jawaban_d;
            if (document.getElementById('editE')) {
                document.getElementById('editE').value = soal.jawaban_e ?? '';
            }
            document.getElementById('editBenar').value = soal.jawaban_benar.toLowerCase();
            document.getElementById('editPoint').value = soal.point;

            // Preview gambar
            const previewImg = document.querySelector("#previewGambar img");
            if (soal.gambar) {
                previewImg.src = `/storage/${soal.gambar}`;
                previewImg.classList.remove('hidden');
            } else {
                previewImg.classList.add('hidden');
            }

            // Tampilkan modal
            document.getElementById('modalEditSoal').classList.remove('hidden');
        }

    </script>



</x-layout-guru>
