<!-- Tambahkan Style Tailwind untuk Scrollbar -->
    <style>
        /* Custom scrollbar hanya untuk div tertentu */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #9333ea;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #e5e7eb;
        }
    </style>
<x-layout-guru>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 ">
        <!-- Card Siswa 1 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=1" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Rafi Ahmad</h3>
            <p class="text-sm text-gray-500">NIS: 210301</p>
            </div>
        </div>

        <!-- Card Siswa 2 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=2" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Dina Lestari</h3>
            <p class="text-sm text-gray-500">NIS: 210302</p>
            </div>
        </div>

        <!-- Card Siswa 3 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=3" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Alif Nur</h3>
            <p class="text-sm text-gray-500">NIS: 210303</p>
            </div>
        </div>
        </section>
    <div class="max-w-5xl mx-auto">
        <div class="w-full overflow-x-auto custom-scrollbar scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-200 hover:scrollbar-thumb-purple-700">
            <div class="flex min-w-[800px] md:min-w-full space-x-4 px-4 py-2">
                <!-- Step 1 -->
                <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Membuat kelompok</p>
                    <p class="text-xs text-gray-500 text-center">membuat rumusan masalah dan mencari indikator penyebab masalah</p>
                </div>
    
                <!-- Step 2 -->
                <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Menyusun Rencana Proyek</p>
                    <p class="text-xs text-gray-500 text-center">Mempersiapkan rencana pengerjaan proyek</p>
                </div>
    
                <!-- Step 3 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Proyek Dibagikan</p>
                    <p class="text-xs text-gray-500 text-center">Memastikan proyek telah dibagi</p>
                </div>
    
                <!-- Step 4 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Progres Pengerjaan</p>
                    <p class="text-xs text-gray-500 text-center">Siswa Melaksanakan Tugas sesuai Jadwal</p>
                </div>
    
                <!-- Step 5 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Pengumpulan Proyek</p>
                    <p class="text-xs text-gray-500 text-center">Mengumpulkan hasil proyek</p>
                </div>
    
                <!-- Step 6 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Kelompok Presentasi</p>
                    <p class="text-xs text-gray-500 text-center">Memaparkan hasil proyek</p>
                </div>
    
                <!-- Step 7 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                        7
                    </div>
                    <p class="text-sm font-bold text-purple-500 mt-2 text-center">Evaluasi & perbaikan</p>
                    <p class="text-xs text-gray-500 text-center">Pemberian evaluasi dan perbaikan projeck</p>
                </div>
    
                <!-- Step 8 -->
                <div class="flex flex-col items-center min-w-[180px] p-4">
                    <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-500 rounded-full font-bold">
                        8
                    </div>
                    <p class="text-sm font-bold text-purple-500 mt-2 text-center">Refleksi</p>
                    <p class="text-xs text-gray-500 text-center">Pemberian pemahaman mengenai PJBL</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-full border-r border-gray-300 p-4 overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Diskusi</h2>
        <div id="chatBox" class="space-y-6">
            <div class="bg-white p-3 rounded-lg shadow">
              <p class="text-sm text-gray-800">👤 <strong>Ana</strong>: Halo semuanya!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Ana')">Reply</button>
            </div>
            <div class="bg-white p-3 rounded-lg shadow ml-4">
              <p class="text-sm text-gray-800">↪️ <strong>Budi</strong>: Hai Ana!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Budi')">Reply</button>
            </div>
            <div class="bg-white p-3 rounded-lg shadow">
              <p class="text-sm text-gray-800">👤 <strong>Budi</strong>: Bagaimana Cara untuk menyimpulkannya!</p>
              <button class="text-xs text-purple-600 mt-1 hover:underline" onclick="reply('Budi')">Reply</button>
            </div>
          </div>
          <input type="text" id="rumusan-masalah" class="border-2 border-gray-300 p-3 w-full mt-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Mulai Pembicaraan">
            
                <!-- Tombol Next -->
                <div class="mt-4">
                    <a href="/siswa/pjbl/8" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-md transition">
                        Submit
                    </a>
                </div>
    </div>
</x-layout-guru>