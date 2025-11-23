<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Aktivitas</h1>
        <p class="text-gray-600 mt-1">Project Based Learning</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Aktivitas Project Based Learning</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Aktivitas</button>
        </div>
    
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Urutan Aktivitas</th>
                    <th>Judul</th>
                    <th>Penjelasan</th>
                    <th>Waktu Pengerjaan</th>
                    <th>Waktu Mulai</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($syntax as $s)
                <tr>
                    <td>{{ $s->urutan }}</td>
                    <td>{{ $s->nama_syntax }}</td>
                    <td>{{ $s->penjelasan }}</td>
                    <td>{{ $s->waktu }}</td>
                    <td>{{ $s->waktu_mulai }}</td>
                    <td class="flex gap-2">
                        <!-- Tombol Edit -->
                        <button onclick="editSyntax({{ $s }})"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Edit
                    </button>

                        <!-- Form Delete -->
                        <form action="{{ route('guru.aktivitas_pjbl.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $s->id }}">
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
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
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative my-10 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Syntax</h3>
    
            <form action="{{ route('guru.aktivitas_pjbl.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus->id }}">
    
                <!-- Urutan Syntax -->
                <div>
                    <label for="urutan" class="block mb-2 text-sm font-medium text-gray-900">Urutan Syntax</label>
                    <input type="number" name="urutan" id="urutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>

                <!-- Pertemuan -->
                <div>
                    <label for="id_pertemuan" class="block mb-2 text-sm font-medium text-gray-900">Pertemuan</label>
                    <select name="id_pertemuan" id="id_pertemuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                        <option value="">Pilih Pertemuan</option>
                        @foreach ($pertemuan as $p)
                            <option value="{{ $p->id }}">{{ $p->judul_pertemuan }} ({{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }})</option>
                        @endforeach
                    </select>
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
    
                <!-- pengumpulan_tugas -->
                <div>
                    <label for="pengumpulan_tugas" class="block mb-2 text-sm font-medium text-gray-900">pengumpulan_tugas</label>
                    <select name="pengumpulan_tugas" id="pengumpulan_tugas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                        <option value="1">Text Field</option>
                        <option value="2">File Input</option>
                        <option value="3">Penugasan</option>
                        <option value="4">Penugasan dengan Deadline</option>
                        <option value="5">Trello</option>
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
    
    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative my-10 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Syntax</h3>

            <form id="formEdit" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus->id }}">

                <!-- (Input fields sama seperti form tambah, bisa copy & paste) -->
                <!-- Urutan Syntax -->
                <div>
                    <label for="urutan" class="block mb-2 text-sm font-medium text-gray-900">Urutan Syntax</label>
                    <input type="number" name="urutan" id="urutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 1, 2, 3..." required>
                </div>

                <!-- Pertemuan -->
                <div>
                    <label for="id_pertemuan" class="block mb-2 text-sm font-medium text-gray-900">Pertemuan</label>
                        <select name="id_pertemuan" id="id_pertemuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="">Pilih Pertemuan</option>
                            @foreach ($pertemuan as $p)
                                <option value="{{ $p->id }}" {{ old('id_pertemuan') == $p->id ? 'selected' : '' }}>
                                    {{ $p->judul_pertemuan }} ({{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }})
                                </option>
                            @endforeach
                        </select>
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
    
                <!-- pengumpulan_tugas -->
                <div>
                    <label for="pengumpulan_tugas" class="block mb-2 text-sm font-medium text-gray-900">pengumpulan_tugas</label>
                    <select name="pengumpulan_tugas" id="pengumpulan_tugas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                        <option value="1">Text Field</option>
                        <option value="2">File Input</option>
                        <option value="3">Penugasan</option>
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
                    <button type="button" onclick="toggleModalEdit(false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                </div>
            </form>

            <button onclick="toggleModalEdit(false)" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
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
        function editSyntax(data) {
            toggleModalEdit(true); // Ganti ke modal edit

            const form = document.querySelector('#modalEdit form'); // ambil form edit
            form.action = @json(route('guru.aktivitas_pjbl.update', ['id' => '__ID__'])).replace('__ID__', data.id);

            // Set method PUT
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Isi input form
            form.querySelector('[name="urutan"]').value = data.urutan;
            form.querySelector('[name="id_pertemuan"]').value = data.id_pertemuan;
            form.querySelector('[name="nama_syntax"]').value = data.nama_syntax;
            form.querySelector('[name="slug"]').value = data.slug;
            form.querySelector('[name="penjelasan"]').value = data.penjelasan;
            form.querySelector('[name="pengumpulan_tugas"]').value = data.pengumpulan_tugas ?? '';
            form.querySelector('[name="waktu_mulai"]').value = data.waktu_mulai?.slice(0, 16);
            form.querySelector('[name="waktu"]').value = data.waktu;

            // Hidden ID jika perlu
            let idInput = form.querySelector('input[name="id"]');
            if (!idInput) {
                idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'id';
                form.appendChild(idInput);
            }
            idInput.value = data.id;
        }
    function toggleModalEdit(show) {
        const modal = document.getElementById('modalEdit');
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');

            const form = modal.querySelector('form');
            form.reset();
            form.action = ""; // reset action
        }
    }


    function toggleModal(show) {
        const modal = document.getElementById('modalForm');
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');

            // Reset form
            const form = modal.querySelector('form');
            form.reset();
            form.action = "{{ route('guru.aktivitas_pjbl.store') }}";
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            const idInput = form.querySelector('input[name="id"]');
            if (idInput) idInput.remove();
        }
    }

</script>

</x-layout-guru>
