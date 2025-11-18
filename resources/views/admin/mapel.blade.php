<x-layout-guru>
        {{-- === Tambah Mapel Card === --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 border-b-4 border-purple-600">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Mata Pelajaran</h2>

       <form action="{{ url('/admin/store/mapel') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-sm text-gray-700">Nama Mapel</label>
                    <input type="text" name="nama_mapel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="id_user" class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                    <select name="id_user" id="id_user" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}" class="text-gray-800">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($kelas as $kls)
                            <option value="{{ $kls->id }}" class="text-gray-800">{{ $kls->Kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <label class="block mb-1 font-medium text-sm text-gray-700">Deskripsi</label>
                <textarea name="deskripsi_mapel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
        </form>
    </div>

    {{-- === Daftar Mapel Card === --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Daftar Mata Pelajaran</h1>

        <table id="mapelTable" class="display w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Guru</th>
                    <th>Kelas</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mapels as $mapel)
                <tr>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td>{{ $mapel->users->nama ?? '-' }}</td>
                    <td>{{ $mapel->kelas->Kelas ?? '-' }}</td>
                    <td>{{ $mapel->deskripsi_mapel }}</td>
                    <td>
                        <button onclick="openEditModal({{ $mapel }})" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Edit</button>
                        <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Modal Edit --}}
    <div id="modalEditMapel" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white shadow-md rounded-md w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Mapel</h3>

            <form id="formEditMapel" method="POST" data-route="{{ route('admin.mapel.update', ':id') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_nama_mapel" class="block text-sm font-medium text-gray-700">Nama Mapel</label>
                    <input type="text" name="nama_mapel" id="edit_nama_mapel"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

               <div class="mb-4">
                    <label for="edit_id_user" class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                    <select name="id_user" id="edit_id_user"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="edit_id_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select name="id_kelas" id="edit_id_kelas"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                        @foreach($kelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->Kelas }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="edit_deskripsi_mapel" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi_mapel" id="edit_deskripsi_mapel"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleEditModal(false)"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>

            <button onclick="toggleEditModal(false)"
                class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
        </div>
    </div>


    {{-- Scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#mapelTable').DataTable();
        });

        function openEditModal(mapel) {
            const form = document.getElementById('formEditMapel'); // ← tambahkan ini

            form.action = form.dataset.route.replace(':id', mapel.id);
            document.getElementById('edit_nama_mapel').value = mapel.nama_mapel;
            document.getElementById('edit_deskripsi_mapel').value = mapel.deskripsi_mapel;
            document.getElementById('edit_id_user').value = mapel.id_user;
            document.getElementById('edit_id_kelas').value = mapel.id_kelas;

            toggleEditModal(true);
        }


    function toggleEditModal(show) {
        const modal = document.getElementById('modalEditMapel');
        modal.classList.toggle('hidden', !show);
    }
    </script>
</x-layout-guru>
