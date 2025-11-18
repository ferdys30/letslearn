<x-layout-guru>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <section 
        x-data="{
            showModal: false,
            showEditModal: false,
            editId: null,
            editForm: {
                nama_posisi: ''
            },
            openEditModal(data) {
                this.editId = data.id;
                this.editForm = { ...data };
                this.showEditModal = true;
            }
        }"
        class="px-6 py-6 bg-white shadow-md rounded-md mb-6"
    >
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-3xl font-bold text-gray-800 text-left">Posisi</h2>
            <button @click="showModal = true" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Posisi</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nama Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posisi as $p)
                    <tr>
                        <td>{{ $p->nama_posisi }}</td>
                        <td>
                            <div class="flex space-x-3">

                                <!-- Tombol Hapus -->
                                <form method="POST" action="{{ route('guru.posisi.delete', $p->id) }}" onsubmit="return confirm('Yakin ingin menghapus posisi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah Posisi -->
        <div x-show="showModal" x-transition x-cloak class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Posisi</h3>
                <form action="{{ route('guru.posisi.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                    <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus->id }}">
                    <div>
                        <label for="nama_posisi" class="block mb-2 text-sm font-medium text-gray-700">Nama Posisi</label>
                        <input type="text" name="nama_posisi" id="nama_posisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Masukkan nama posisi..." required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
                <button @click="showModal = false" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-layout-guru>
