<x-navbar-siswa></x-navbar-siswa>
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
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
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

    <div class="w-full overflow-x-auto custom-scrollbar scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-200 hover:scrollbar-thumb-purple-700">
        <div class="flex w-[150%] md:w-full space-x-4 px-4 py-2">
            <!-- Step 1 -->
            <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    ✔
                </div>
                <p class="text-sm font-bold mt-2 text-center">Rumusan & Indikator</p>
                <p class="text-xs text-gray-500 text-center">membuat rumusan masalah dan mencari indikator penyebab masalah</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 2 (Active) -->
            <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    ✔
                </div>
                <p class="text-sm font-bold mt-2 text-center">Menyusun Rencana Proyek</p>
                <p class="text-xs text-gray-500 text-center">Mempersiapkan rencana pengerjaan proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 3 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    ✔
                </div>
                <p class="text-sm font-bold mt-2 text-center">Proyek Dibagikan</p>
                <p class="text-xs text-gray-500 text-center">Memastikan proyek telah dibagi</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 4 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    4
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Progres Pengerjaan</p>
                <p class="text-xs text-gray-500 text-center">Siswa Melaksanakan Tugas sesuai Jadwal</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 5 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    5
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">pengumpulan_tugas Proyek</p>
                <p class="text-xs text-gray-500 text-center">Mengumpulkan hasil proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 6 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    6
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">kelompok_pjbl Presentasi</p>
                <p class="text-xs text-gray-500 text-center">Memaparkan hasil proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 7 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    7
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Evaluasi & perbaikan</p>
                <p class="text-xs text-gray-500 text-center">Pemberian evaluasi dan perbaikan projeck</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 8 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    8
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2">Refleksi</p>
                <p class="text-xs text-gray-500 text-center">Pemberian pemahaman mengenai aktivitas_pjbl</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
        </div>
    </div>
    
    <section class="w-full h-400 bg-white shadow-md rounded-none p-8 mt-2 relative">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between">
            <!-- Gambar -->
            <div class="lg:w-1/2 flex justify-center lg:text-right mt-8 lg:mt-0">
                <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-full max-w-sm">
            </div>
    
            <!-- Teks -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Progres Pengerjaan kelompok_pjbl 1</h2>
                <!-- Isi Studi Kasus -->
                <p class="text-gray-700 text-lg leading-relaxed mb-6">
                    Anda diminta untuk mencari Indikator Penyebab Masalah dari studi kasus yang telah diberikan. Carilah Indikator Masalah yang bisa kamu dapatkan dari studi kasus tersebut.
                </p>
                {{-- <input type="text" id="rumusan-masalah" class="border-2 border-gray-300 p-3 w-full mt-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan rumusan masalah..."> --}}
            
                <!-- Tombol Next -->
                <div class="mt-4">
                    <a href="/siswa/aktivitas_pjbl/5" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-md transition">
                        Next →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-2 lg:px-20 py-12 bg-white rounded-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-3xl font-bold text-gray-800 text-left">siklus_pjbl</h2>
            {{-- <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah siklus_pjbl</button> --}}
        </div>
        {{-- <p class="text-gray-600 text-left mt-2">Pilih kelas yang ingin kamu pelajari!</p> --}}
  
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Pemrograman Web -->
            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col text-left">
                <h3 class="text-xl font-semibold text-gray-800">Halaman Dasboard</h3>
                <p class="text-gray-600 mt-2">Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.</p>
                
                <!-- Deadline Waktu -->
                <div class="mt-4 text-sm text-gray-500 flex justify-between">
                    <p>Deadline: <span class="font-semibold text-purple-600">10 Mei 2025</span></p>
                    <p>Tugas: <span class="font-semibold text-purple-600">Doni</span></p>
                </div>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                        <span class="text-xs font-semibold inline-block py-1 uppercase">11%/100%</span>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 11%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col text-left">
                <h3 class="text-xl font-semibold text-gray-800">Desain CSS</h3>
                <p class="text-gray-600 mt-2">Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.</p>
                
                <!-- Deadline Waktu -->
                <div class="mt-4 text-sm text-gray-500 flex justify-between">
                    <p>Deadline: <span class="font-semibold text-purple-600">10 Mei 2025</span></p>
                    <p>Tugas: <span class="font-semibold text-purple-600">Doni</span></p>
                </div>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                        <span class="text-xs font-semibold inline-block py-1 uppercase">77%/100%</span>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 77%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col text-left">
                <h3 class="text-xl font-semibold text-gray-800">Tambahan Javascript</h3>
                <p class="text-gray-600 mt-2">Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.</p>
                
                <!-- Deadline Waktu -->
                <div class="mt-4 text-sm text-gray-500 flex justify-between">
                    <p>Deadline: <span class="font-semibold text-purple-600">10 Mei 2025</span></p>
                    <p>Tugas: <span class="font-semibold text-purple-600">Doni</span></p>
                </div>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <span class="text-xs font-semibold inline-block py-1 uppercase">Progress</span>
                        <span class="text-xs font-semibold inline-block py-1 uppercase">33%/100%</span>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 33%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
  
            <!-- Card Pemrograman Grafis -->
            {{-- <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Grafis</h3>
                <p class="text-gray-600 mt-2">Pelajari bagaimana membuat desain dan animasi dengan teknik pemrograman grafis.</p>
                <a href="#" class="mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    Lihat Kelas
                </a>
            </div> --}}
        </div>
      </section>

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
                    <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-md transition">
                        Submit
                    </button>
                </div>

</x-layout-siswa>