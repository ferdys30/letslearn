<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Data Penilaian Siswa</h2>
            {{-- <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Kuis</button> --}}
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Rata Rata Nilai Kuis</th>
                    <th>Project Based Learning</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ferdy</td>
                    <td>21050974028</td>
                    <td>60</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Septiawan</td>
                    <td>21050974029</td>
                    <td>75</td>
                    <td>60</td>
                </tr>
            </tbody>
        </table>
    </section>



    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
