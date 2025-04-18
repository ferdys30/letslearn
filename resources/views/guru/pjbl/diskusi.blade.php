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
                        ✔
                    </div>
                    <p class="text-sm font-bold mt-2 text-center">Evaluasi & perbaikan</p>
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
    
</x-layout-guru>