<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- RoomChat - KIRI -->
    <div class="flex min-h-screen">
    <div class="w-1/2 border-r border-gray-300 p-4 overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Hasil Diskusi Ferdy</h2>
        <div id="chatBox" class="space-y-6">
          <!-- Bagian aktivitas_pjbl 1 -->
          <div>
            <div class="text-center text-lg font-semibold text-purple-700 border-t border-gray-300 pt-4 mb-2 uppercase tracking-wide">
              🧩 Bagian aktivitas_pjbl 1
            </div>
            <div class="bg-white p-3 rounded-lg shadow">
              <p class="text-sm text-gray-800">👤 <strong>Ana</strong>: Halo semuanya!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Ana')">Reply</button>
            </div>
            <div class="bg-white p-3 rounded-lg shadow ml-4">
              <p class="text-sm text-gray-800">↪️ <strong>Budi</strong>: Hai Ana!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Budi')">Reply</button>
            </div>
          </div>
        
          <!-- Bagian aktivitas_pjbl 2 -->
          <div>
            <div class="text-center text-lg font-semibold text-purple-700 border-t border-gray-300 pt-4 mb-2 uppercase tracking-wide">
              🧩 Bagian aktivitas_pjbl 2
            </div>
            <div class="bg-white p-3 rounded-lg shadow">
              <p class="text-sm text-gray-800">👤 <strong>Budi</strong>: Bagaimana Cara untuk menyimpulkannya!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Budi')">Reply</button>
            </div>
          </div>
        </div>
        
  
        <!-- Input chat -->
        {{-- <div class="mt-6">
          <form id="chatForm" onsubmit="sendMessage(event)">
            <input type="text" id="chatInput" placeholder="Tulis pesan..." class="w-full p-2 rounded border border-gray-400 mb-2" />
            <button type="submit" class="px-4 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">Kirim</button>
          </form>
        </div> --}}
      </div>
  
      <!-- Nilai - KANAN -->
      <div class="w-1/2 p-6">
        <div class="bg-white p-6 rounded-2xl shadow-lg">
          <h2 class="text-xl font-bold text-gray-800 mb-4">📊 Nilai Kuis Ferdy</h2>
          <p class="text-gray-700 text-lg">Kuis 1: <span class="font-semibold">90</span></p>
          <p class="text-gray-700 text-lg">Kuis 2: <span class="font-semibold">-</span></p>
          <p class="text-gray-700 text-lg">Total: <span class="font-bold text-purple-700">90</span></p>
        </div>
        <div class="bg-white p-6 mt-5 rounded-2xl shadow-lg">
          <h2 class="text-xl font-bold text-gray-800 mb-4">📊 Nilai Project Ferdy</h2>
        
          <p class="text-gray-700 text-lg">Project 1: <span class="font-semibold">90</span></p>
        
          <div class="text-gray-700 text-lg flex items-center justify-between mb-2">
            <span>Project 2:</span>
            <a href="javascript:void(0)" onclick="openModal()" class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-900 transition">
              Tambahkan Nilai
            </a>
          </div>
        
          <p class="text-gray-700 text-lg">Total: <span class="font-bold text-purple-700">90</span></p>
        </div>        
      </div>
  
    </div>
</div>
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
          
          {{-- pembatas kognitif --}}
          <tr>
            <td class="p-1 border-b bg-gray-100 font-bold text-lg text-gray-800" colspan="6">
              Psikomotorik
            </td>
          </tr>
          <!-- Tambahkan indikator lain seperti ini -->
          <tr class="border-b">
            <td class="p-2">Siswa mampu mendesain layout halaman website dengan menggunakan CSS</td>
            <td class="p-2 text-center">
              <input type="radio" name="indikator2" value="1" class="form-radio text-green-600 h-5 w-5">
            </td>
            <td class="p-2 text-center">
              <input type="radio" name="indikator2" value="2" class="form-radio text-green-600 h-5 w-5">
            </td>
            <td class="p-2 text-center">
              <input type="radio" name="indikator2" value="3" class="form-radio text-green-600 h-5 w-5">
            </td>
            <td class="p-2 text-center">
              <input type="radio" name="indikator2" value="4" class="form-radio text-green-600 h-5 w-5">
            </td>
            <td class="p-2 text-center">
              <input type="radio" name="indikator2" value="5" class="form-radio text-green-600 h-5 w-5">
            </td>
          </tr>

          <!-- Tambahkan semua indikator lainnya dengan pola yang sama -->
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
