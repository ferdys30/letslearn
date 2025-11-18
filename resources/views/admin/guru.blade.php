<x-layout-guru>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Data Guru</h1>
    </section>

    <section class="px-6 py-6 bg-white shadow-md rounded-md">
        <table id="guruTable" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    {{-- <th>Email</th> --}}
                    <th>Username</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guruList as $guru)
                    <tr>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->nip ?? '-' }}</td>
                        {{-- <td>{{ $guru->email ?? '-' }}</td> --}}
                        <td>{{ $guru->username }}</td>
                        <td class="space-x-2">
                            <button onclick="openEditModal({{ $guru->id }}, '{{ $guru->nama }}', '{{ $guru->nip }}', '{{ $guru->email }}', '{{ $guru->username }}')" class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit
                            </button>

                            <form action="{{ route('admin.resetPassword', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin reset password untuk {{ $guru->nama }}?')">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                    Reset Password
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Modal Edit Guru -->
    <div id="modalEditGuru" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white shadow-md rounded-md w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Data Guru</h3>

            <form id="formEditGuru" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="edit_nama" class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="edit_nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" name="nip" id="edit_nip" class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="edit_email" class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="edit_username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="edit_username" class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleEditModal(false)" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>

            <!-- Close -->
            <button onclick="toggleEditModal(false)" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
        </div>
    </div>



    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#guruTable').DataTable();
        });
    </script>
    <script>
        function toggleEditModal(show) {
            const modal = document.getElementById('modalEditGuru');
            if (modal) {
                modal.classList.toggle('hidden', !show);
            }
        }

        function openEditModal(id, nama, nip, email, username) {
            console.log("Buka modal untuk ID:", id);

            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_nip').value = nip !== 'null' ? nip : '';
            document.getElementById('edit_email').value = email !== 'null' ? email : '';
            document.getElementById('edit_username').value = username;

            const form = document.getElementById('formEditGuru');
            form.action = `{{ route('admin.guru.update', ':id') }}`.replace(':id', id);

            toggleEditModal(true);
        }
    </script>

</x-layout-guru>