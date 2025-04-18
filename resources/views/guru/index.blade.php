<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Pak Adit 👋</h1>
        <p class="text-gray-600 mt-1">Senang melihat Anda kembali! Silakan pilih kelas atau lihat data yang tersedia.</p>
    </section>

    <!-- Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left">Data Nilai Siswa</h2>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
      <h2 class="text-3xl font-bold text-gray-800 text-left">Kelas Saya</h2>
      {{-- <p class="text-gray-600 text-left mt-2">Pilih kelas yang ingin kamu pelajari!</p> --}}

      <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Card Pemrograman Web -->
          <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
              <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Web</h3>
              <p class="text-gray-600 mt-2">Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.</p>
              <a href="#" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                  Lihat Kelas
              </a>
          </div>

          <!-- Card Pemrograman Grafis -->
          <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
              <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Grafis</h3>
              <p class="text-gray-600 mt-2">Pelajari bagaimana membuat desain dan animasi dengan teknik pemrograman grafis.</p>
              <a href="#" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                  Lihat Kelas
              </a>
          </div>

          <!-- Card Pemrograman Web -->
          <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
              <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Web</h3>
              <p class="text-gray-600 mt-2">Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.</p>
              <a href="#" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                  Lihat Kelas
              </a>
          </div>

          <!-- Card Pemrograman Grafis -->
          <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
              <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Grafis</h3>
              <p class="text-gray-600 mt-2">Pelajari bagaimana membuat desain dan animasi dengan teknik pemrograman grafis.</p>
              <a href="#" class="mt-4 px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                  Lihat Kelas
              </a>
          </div>
      </div>
    </section>

    <!-- JS jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
