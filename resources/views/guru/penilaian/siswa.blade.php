<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <!-- RoomChat - KIRI -->
    <div class="flex min-h-screen">
    <div class="w-1/2 border-r border-gray-300 p-4 overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Diskusi Siswa</h2>
        <div id="chatBox" class="space-y-4">
          <!-- Contoh chat -->
          <div class="bg-white p-3 rounded-lg shadow">
            <p class="text-sm text-gray-800">👤 <strong>Ana</strong>: Halo semuanya!</p>
            <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Ana')">Reply</button>
          </div>
          <div class="bg-white p-3 rounded-lg shadow ml-4">
            <p class="text-sm text-gray-800">↪️ <strong>Budi</strong>: Hai Ana!</p>
            <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Budi')">Reply</button>
          </div>
        </div>
  
        <!-- Input chat -->
        <div class="mt-6">
          <form id="chatForm" onsubmit="sendMessage(event)">
            <input type="text" id="chatInput" placeholder="Tulis pesan..." class="w-full p-2 rounded border border-gray-400 mb-2" />
            <button type="submit" class="px-4 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">Kirim</button>
          </form>
        </div>
      </div>
  
      <!-- Nilai - KANAN -->
      <div class="w-1/2 p-6">
        <div class="bg-white p-6 rounded-2xl shadow-lg">
          <h2 class="text-xl font-bold text-gray-800 mb-4">📊 Nilai Kamu</h2>
          <p class="text-gray-700 text-lg">Tugas 1: <span class="font-semibold">90</span></p>
          <p class="text-gray-700 text-lg">Tugas 2: <span class="font-semibold">85</span></p>
          <p class="text-gray-700 text-lg">Total: <span class="font-bold text-purple-700">87.5</span></p>
        </div>
      </div>
  
    </div>
</div>
  


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
