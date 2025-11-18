<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Tambahkan Studi Kasus</h1>
        <p class="text-gray-600 mt-1">Project Based Learning</p>
    </section>

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Studi Kasus kelompok_pjbl</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Studi Kasus</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>kelompok_pjbl</th>
                    <th>Studi Kasus</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studi_kasus as $sk)
                    
                <tr>
                    <td>{{ $sk->kelompok_pjbl->nama_kelompok_pjbl }}</td>
                    <td>{{ $sk->studi_kasus }}</td>
                    <td class="space-x-2">
                        <button 
                            onclick="openEditModal({{ $sk->id }}, `{{ addslashes($sk->studi_kasus) }}`)"
                            class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm"
                        >Edit</button>

                        <form action="{{ route('guru.studi_kasus.destroy', $sk->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" 
                                class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm"
                            >Hapus</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Modal -->
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Studi Kasus</h3>

            <form action="{{ route('guru.studi_kasus.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Input No kelompok_pjbl -->
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                <div>
                    <label for="id_kelompok_pjbl" class="block mb-2 text-sm font-medium text-gray-700 ">No. kelompok_pjbl</label>
                    <select name="id_kelompok_pjbl" id="id_kelompok_pjbl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                        <option value="">Pilih kelompok_pjbl</option>
                        @foreach ($kelompok_pjbl as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama_kelompok_pjbl }}</option>
                        @endforeach
                    </select>                        
                </div>
        
                <!-- Textarea Studi Kasus -->
                <!-- Textarea Studi Kasus -->
                <div>
                    <label for="studi_kasus" class="block text-sm font-medium text-gray-700 mb-2">Studi Kasus</label>
                    <textarea name="studi_kasus" id="studi_kasus" rows="5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5"
                        placeholder="Tuliskan studi kasus di sini..." required></textarea>
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

    <!-- Modal Edit Studi Kasus -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-md shadow-md p-6 w-full max-w-lg">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit Studi Kasus</h2>
            <form id="editForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="edit_studi_kasus">Studi Kasus</label>
                    <textarea id="edit_studi_kasus" name="studi_kasus" class="w-full border border-gray-300 rounded-md p-2" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-purple-600 text-white hover:bg-purple-700">Simpan</button>
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
        function openEditModal(id, studiKasus) {
            const routeTemplate = "{{ route('guru.studi_kasus.update', ':id') }}";
            const editRoute = routeTemplate.replace(':id', id);

            document.getElementById('editForm').action = editRoute;
            document.getElementById('edit_studi_kasus').value = studiKasus;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
    </script>


</x-layout-guru>
