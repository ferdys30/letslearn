<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mata Pelajaran Pemrograman Website</h1>
        <p class="text-gray-600 mt-1 flex justify-between items-center">
            Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.
            <button class="text-sm text-purple-600 hover:underline" onclick="editItem(1)">Edit</button>
        </p>
    </section>   
    
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left mb-4">Tujuan Pembelajaran</h2>
      
        <!-- Card Pemrograman Web -->
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full text-gray-800">
          <!-- List Materi -->
          <ul class="space-y-3 mb-6">
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
              <span>1. Memahami dan Menerapkan HTML</span>
              <button class="text-sm text-purple-600 hover:underline" onclick="editItem(1)">Edit</button>
            </li>
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
              <span>2. Menerapkan Perintah CSS</span>
              <button class="text-sm text-purple-600 hover:underline" onclick="editItem(2)">Edit</button>
            </li>
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
              <span>3. Menerapkan Perintah Pemrograman Javascript</span>
              <button class="text-sm text-purple-600 hover:underline" onclick="editItem(3)">Edit</button>
            </li>
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
              <span class="text-gray-500 italic">+ Tambah Data</span>
              <button class="text-sm text-green-600 hover:underline font-medium" onclick="addItem()">Tambah</button>
            </li>
          </ul>
        </div>
      </section>
      
    
    <!-- Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-3xl font-bold text-gray-800 text-left">Indikator Penilaian</h2>
            <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Indikator</button>
        </div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Indikator Penilaian</th>
                    <th>Aspek</th>
                    <th>Skala 1</th>
                    <th>Skala 2</th>
                    <th>Skala 3</th>
                    <th>Skala 4</th>
                    <th>Skala 5</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris 1 -->
                <tr>
                    <td>Siswa dapat membuat website menggunakan minimal 2 hyperlink pada halaman website</td>
                    <td>Kognitif</td>
                    <td> Tidak tahu cara menambahkan hyperlink</td>
                    <td> Dapat menambahkan 1 hyperlink, kesulitan dengan yang kedua</td>
                    <td> Dapat menambahkan 2 hyperlink dengan bantuan</td>
                    <td> Dapat menambahkan 2 hyperlink secara mandiri dengan baik</td>
                    <td> Dapat menambahkan 2 atau lebih hyperlink dengan sempurna, sesuai standar</td>
                </tr>
                <!-- Baris 2 -->
                <tr>
                    <td>Siswa mampu mendesain layout halaman website dengan menggunakan CSS</td>
                    <td>Keterampilan</td>
                    <td> Tidak tahu cara menggunakan CSS sama sekali</td>
                    <td> Hanya bisa menggunakan CSS dasar, kesulitan dalam positioning</td>
                    <td> Menggunakan CSS dasar dengan bantuan, namun layout masih kurang rapi</td>
                    <td> Mendesain layout yang bersih dan rapi, menggunakan teknik CSS yang benar</td>
                    <td> Mendesain layout yang responsif dan dinamis dengan CSS yang kompleks</td>
                </tr>
                <!-- Baris 3 -->
                <tr>
                    <td>Siswa dapat menggunakan JavaScript untuk interaksi sederhana pada website</td>
                    <td>Kognitif</td>
                    <td> Tidak mengerti konsep dasar JavaScript</td>
                    <td> Dapat menulis kode JavaScript, namun tidak bisa membuat interaksi yang benar</td>
                    <td> Dapat membuat interaksi dasar, tetapi masih terdapat kesalahan pada beberapa bagian</td>
                    <td> Dapat membuat interaksi dinamis yang berfungsi dengan baik menggunakan JavaScript</td>
                    <td> Mampu membuat interaksi kompleks dan dinamis tanpa kesalahan</td>
                </tr>
                <!-- Baris 4 -->
                <tr>
                    <td>Siswa mampu membuat form input dengan validasi di halaman web</td>
                    <td>Keterampilan</td>
                    <td> Tidak tahu cara membuat form input dan validasi</td>
                    <td> Dapat membuat form input, tetapi kesulitan dalam menerapkan validasi</td>
                    <td> Dapat membuat form dengan validasi dasar, namun masih banyak kesalahan</td>
                    <td> Membuat form input dan validasi yang berfungsi dengan baik secara mandiri</td>
                    <td> Membuat form yang sangat baik, dengan validasi yang sangat tepat dan aman</td>
                </tr>
                <!-- Baris 5 -->
                <tr>
                    <td>Siswa dapat mengoptimalkan halaman website untuk tampilan responsif</td>
                    <td>Kognitif</td>
                    <td> Tidak tahu cara membuat halaman responsif</td>
                    <td> Dapat membuat halaman responsif dengan bantuan, namun ada masalah tampilan</td>
                    <td> Membuat halaman responsif, namun masih ada masalah dengan beberapa resolusi layar</td>
                    <td> Dapat membuat halaman responsif yang baik di berbagai perangkat</td>
                    <td> Halaman responsif yang sempurna di semua perangkat dengan tampilan optimal</td>
                </tr>
                <!-- Baris 6 -->
                <tr>
                    <td>Siswa mampu menggunakan library atau framework CSS seperti Bootstrap</td>
                    <td>Keterampilan</td>
                    <td> Tidak tahu cara menggunakan library atau framework CSS</td>
                    <td> Dapat menggunakan beberapa fitur dasar, tetapi kesulitan dalam implementasi penuh</td>
                    <td> Menggunakan library CSS, namun belum sepenuhnya maksimal dalam layout dan komponen</td>
                    <td> Menggunakan Bootstrap atau library CSS lain secara mandiri dengan desain yang baik</td>
                    <td> Menguasai library CSS, dapat membuat tampilan halaman yang kompleks dan responsif</td>
                </tr>
            </tbody>
        </table>        
    </section>
    <!-- JS jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</x-layout-guru>
