<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section: Selamat Datang -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Pak Adi 👋</h1>
        <p class="text-gray-600 mt-1">Senang melihat Anda kembali! Silakan pilih kelas atau lihat data yang tersedia.</p>
    </section>

    <!-- Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left">Data Kelompok</h2>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>Studi Kasus Yang Didapatkan</th>
                    <th>Anggota</th>
                    <th>Progres Pengerjaan</th>
                    <th>Project</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>OneClub</td>
                    <td>Sekolah merupakan tempat dimana siswa dapat menimba ilmu...</td>
                    <td>
                        <ol>
                          <li>1. saya</li>
                          <li>2. kamu</li>
                        </ol>
                    </td>                      
                    <td>
                        <div class="relative pt-1">
                            <a href="/guru/pjbl/diskusi">
                                <div class="flex mb-2 items-center justify-between">
                                  <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                                  <span class="text-xs font-semibold inline-block py-1 uppercase">100%/100%</span>
                              </div>
                            </a>
                            <div class="flex mb-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="mt-2 px-4 py-2 bg-blue-600 text-center text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                             Lihat
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="openModal()" class="mt-2 px-4 py-2 bg-green-600 text-center text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                            Nilai
                       </a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SecondClass</td>
                    <td>Pahlawan sosok seseorang yang memperjuangkan negara dimana...</td>
                    <td>
                        <ol>
                          <li>1. saya</li>
                          <li>2. kamu</li>
                        </ol>
                    </td>   
                    <td>
                        <div class="relative pt-1">
                            <a href="/guru/pjbl/diskusi">
                              <div class="flex mb-2 items-center justify-between">
                                <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                                <span class="text-xs font-semibold inline-block py-1 uppercase">87.5%/100%</span>
                            </div>
                            </a>
                            <div class="flex mb-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 87.5%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="" class="mt-2 px-4 py-2 bg-blue-600 text-center text-white font-semibold rounded-lg shadow-md cursor-not-allowed">
                          Lihat
                        </a>
                      </td>
                      <td>
                        <a href="javascript:void(0)" onclick="openModal()" disabled class="mt-2 px-4 py-2 bg-gray-400 text-center text-white font-semibold rounded-lg shadow-md cursor-not-allowed">
                          Nilai
                        </a>
                      </td>                      
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
