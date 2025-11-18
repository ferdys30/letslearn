<x-layout-guru>
    {{-- === Tambah Kelas Card === --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 border-b-4 border-purple-600">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Kelas</h2>

        <form action="{{ url('/admin/store/kelas') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-sm text-gray-700">Kelas</label>
                    <input type="text" name="kelas" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
        </form>
    </div>

    {{-- === Daftar Kelas Card === --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Daftar Kelas</h1>

        <table id="kelasTable" class="display w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $kls)
                <tr>
                    <td>{{ $kls->Kelas }}</td>
                    <td>{{ $kls->users_count }}</td>
                    <td>
                        <a href="{{ route('admin.paralel.kelas', $kls->id) }}"
                        class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600">
                            Lihat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    {{-- Scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#kelasTable').DataTable();
        });
    </script>
</x-layout-guru>
