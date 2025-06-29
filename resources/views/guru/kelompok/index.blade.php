<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- Section Tabel -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
      <h2 class="text-3xl font-bold text-gray-800 text-left">Data Kelompok</h2>
      <table id="myTable" class="display">
          <thead> 
              <tr>
                  {{-- <th>No</th> --}}
                  <th>Kelompok</th>
                  <th>Studi Kasus Yang Didapatkan</th>
                  <th>Anggota</th>
                  <th>Progres Pengerjaan</th>
                  <th>Project</th>
                  <th>Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($kelompok as $klmpk)
            <tr>
                <td>{{ $klmpk->nama_kelompok }}</td>
                <td>
                    <ol>
                        @foreach ($klmpk->studi_kasus as $item)
                            <li>{{ $loop->iteration }}. {{ $item->studi_kasus }}</li>
                        @endforeach
                    </ol>
                </td>
                <td>
                    <ol>
                        @foreach ($klmpk->anggota_kelompok as $item)
                            <li>{{ $loop->iteration }}. {{ $item->user->nama }}</li>
                        @endforeach
                    </ol>
                </td>
                <td>
                    <div class="relative pt-1">
                        <a href="/guru/pjbl/diskusi">
                            <div class="flex mb-2 items-center justify-between">
                                <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                                <span class="text-xs font-semibold inline-block py-1 uppercase">{{ $klmpk->progress }}%</span>
                            </div>
                        </a>
                        <div class="flex mb-2">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $klmpk->progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="#" class="mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Lihat
                    </a>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="openModal()" class="mt-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                        Nilai
                    </a>
                </td>
            </tr>
            @endforeach



          </tbody>
      </table>
  </section>
<!-- Modal -->
<div id="nilaiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-4xl p-6 relative">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Penilaian Siswa</h2>
  
      <div class="overflow-y-auto max-h-[400px]">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="p-2 border-b">Indikator</th>
              <th class="p-2 border-b text-center" colspan="5">Nilai</th>
            </tr>
          </thead>
          <tbody>
            {{-- pembatas kognitif --}}
            <tr>
              <td class="p-1 border-b bg-gray-100 font-bold text-lg text-gray-800" colspan="6">
                Kognitif
              </td>
            </tr>          
            <!-- Contoh Baris Indikator -->
            <tr class="border-b">
              <td class="p-2 align-top">
                Siswa dapat membuat website menggunakan minimal 2 hyperlink pada halaman website
              </td>
              <!-- Skala 1 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="1" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Tidak tahu cara menambahkan hyperlink</div>
              </td>
              <!-- Skala 2 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="2" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 1 hyperlink, kesulitan dengan yang kedua</div>
              </td>
              <!-- Skala 3 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="3" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink dengan bantuan</div>
              </td>
              <!-- Skala 4 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="4" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink secara mandiri dengan baik</div>
              </td>
              <!-- Skala 5 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="5" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 atau lebih hyperlink dengan sempurna, sesuai standar</div>
              </td>
            </tr>
            <tr class="border-b">
              <td class="p-2 align-top">
                Siswa dapat membuat website menggunakan minimal 2 hyperlink pada halaman website
              </td>
              <!-- Skala 1 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="1" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Tidak tahu cara menambahkan hyperlink</div>
              </td>
              <!-- Skala 2 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="2" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 1 hyperlink, kesulitan dengan yang kedua</div>
              </td>
              <!-- Skala 3 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="3" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink dengan bantuan</div>
              </td>
              <!-- Skala 4 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="4" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink secara mandiri dengan baik</div>
              </td>
              <!-- Skala 5 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="5" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 atau lebih hyperlink dengan sempurna, sesuai standar</div>
              </td>
            </tr>
            <tr class="border-b">
              <td class="p-2 align-top">
                Siswa dapat membuat website menggunakan minimal 2 hyperlink pada halaman website
              </td>
              <!-- Skala 1 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="1" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Tidak tahu cara menambahkan hyperlink</div>
              </td>
              <!-- Skala 2 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="2" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 1 hyperlink, kesulitan dengan yang kedua</div>
              </td>
              <!-- Skala 3 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="3" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink dengan bantuan</div>
              </td>
              <!-- Skala 4 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="4" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink secara mandiri dengan baik</div>
              </td>
              <!-- Skala 5 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="5" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 atau lebih hyperlink dengan sempurna, sesuai standar</div>
              </td>
            </tr>
            <tr class="border-b">
              <td class="p-2 align-top">
                Siswa dapat membuat website menggunakan minimal 2 hyperlink pada halaman website
              </td>
              <!-- Skala 1 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="1" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Tidak tahu cara menambahkan hyperlink</div>
              </td>
              <!-- Skala 2 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="2" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 1 hyperlink, kesulitan dengan yang kedua</div>
              </td>
              <!-- Skala 3 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="3" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink dengan bantuan</div>
              </td>
              <!-- Skala 4 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="4" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 hyperlink secara mandiri dengan baik</div>
              </td>
              <!-- Skala 5 -->
              <td class="p-2 text-center">
                <input type="radio" name="indikator1" value="5" class="form-radio text-green-600 h-5 w-5 mb-1">
                <div class="text-xs text-gray-600">Dapat menambahkan 2 atau lebih hyperlink dengan sempurna, sesuai standar</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Tombol Tutup Modal -->
      <div class="mt-4 text-right">
        <button onclick="closeModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Simpan
        </button>
        <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
          Tutup
        </button>
      </div>
    </div>
  </div>
    
  
  <!-- JavaScript Modal -->
  <script>
    function openModal() {
      document.getElementById('nilaiModal').classList.remove('hidden');
    }
    
    function closeModal() {
      document.getElementById('nilaiModal').classList.add('hidden');
    }
    </script>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
