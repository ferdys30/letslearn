<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex justify-end mb-4">
            <button 
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded" 
                onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            >
                Tambah Pertemuan
            </button>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 text-left">Data Pertemuan {{ $mapel->nama_mapel }}</h2>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Judul Pertemuan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pertemuans as $pertemuan)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td>{{ $pertemuan->judul_pertemuan }}</td>
                        <td>{{ $pertemuan->tanggal ?? '-' }}</td>
                        <td class="space-x-2">
                            <!-- Tombol Edit -->
                            <button 
                                onclick="editPertemuan({{ $pertemuan }})"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded">
                                Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('guru.pertemuan.destroy', $pertemuan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus pertemuan ini?')" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Modal Tambah Pertemuan -->
    <div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">Tambah Pertemuan</h3>
            <form action="{{ route('guru.pertemuan.store',['mapel' => $mapel->slug]) }}" method="POST">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul Pertemuan</label>
                    <input type="text" name="judul_pertemuan" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="button" 
                            class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2" 
                            onclick="document.getElementById('modalTambah').classList.add('hidden')">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">Edit Pertemuan</h3>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul Pertemuan</label>
                    <input type="text" name="judul_pertemuan" id="edit_judul" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="button" 
                            class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2" 
                            onclick="document.getElementById('modalEdit').classList.add('hidden')">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- JS DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        const routeUpdate = @json(route('guru.pertemuan.update', ['id' => 'ID_PLACEHOLDER']));

        function editPertemuan(pertemuan) {
            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('edit_judul').value = pertemuan.judul_pertemuan;
            document.getElementById('edit_tanggal').value = pertemuan.tanggal;

            const form = document.getElementById('formEdit');
            form.action = routeUpdate.replace('ID_PLACEHOLDER', pertemuan.id); // sesuaikan URL jika berbeda
        }
    </script>
</x-layout-guru>
