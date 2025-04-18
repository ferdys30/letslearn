<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <section class="container mx-auto px-6 lg:px-10 py-6">
      <div class="flex flex-col lg:flex-row items-center lg:justify-between">
          <!-- Teks -->
          <div class="lg:w-1/2 text-center lg:text-left">
              <h1 class="text-4xl font-bold text-gray-800 leading-tight">
                  Selamat Datang di <span class="text-purple-600">Dashboard</span>
              </h1>
              <p class="mt-4 text-gray-600">
                  Kelola data, lihat laporan, dan pantau perkembangan proyek dengan mudah. 
                  Dashboard interaktif untuk pengalaman terbaik!
              </p>
              <div class="mt-6">
                  <a href="#" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300">
                      Mulai Sekarang
                  </a>
              </div>
          </div>

          <!-- Gambar -->
          <div class="lg:w-1/2 flex justify-center lg:justify-end mt-8 lg:mt-0">
              <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-full max-w-md">
          </div>
      </div>
    </section>

    <!-- Section Kelas -->
    <section class="container mx-auto px-6 lg:px-20 py-12 bg-white rounded-md">
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
          {{-- <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
              <h3 class="text-xl font-semibold text-gray-800 mt-4">Pemrograman Grafis</h3>
              <p class="text-gray-600 mt-2">Pelajari bagaimana membuat desain dan animasi dengan teknik pemrograman grafis.</p>
              <a href="#" class="mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                  Lihat Kelas
              </a>
          </div> --}}
      </div>
    </section>

    <section class="w-full py-12 bg-gray-100">
      <div class="max-w-6xl mx-auto text-center">
          <h2 class="text-4xl font-bold text-gray-800 mb-10">Mengapa Memilih Aplikasi Ini?</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
  
              <!-- Alasan 1 -->
              <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                  <div class="text-blue-500 text-5xl mb-4">
                      ⭐
                  </div>
                  <h3 class="text-xl font-semibold text-gray-800">Mudah Digunakan</h3>
                  <p class="text-gray-600 text-center mt-2">Antarmuka yang simpel dan mudah dipahami untuk semua pengguna.</p>
              </div>
  
              <!-- Alasan 2 -->
              <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                  <div class="text-green-500 text-5xl mb-4">
                      🚀
                  </div>
                  <h3 class="text-xl font-semibold text-gray-800">Performa Cepat</h3>
                  <p class="text-gray-600 text-center mt-2">Didesain dengan teknologi terbaru untuk kecepatan maksimal.</p>
              </div>
  
              <!-- Alasan 3 -->
              <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                  <div class="text-yellow-500 text-5xl mb-4">
                      🔒
                  </div>
                  <h3 class="text-xl font-semibold text-gray-800">Keamanan Data</h3>
                  <p class="text-gray-600 text-center mt-2">Melindungi data pengguna dengan sistem enkripsi modern.</p>
              </div>
  
              <!-- Alasan 4 -->
              <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                  <div class="text-red-500 text-5xl mb-4">
                      🎯
                  </div>
                  <h3 class="text-xl font-semibold text-gray-800">Fitur Lengkap</h3>
                  <p class="text-gray-600 text-center mt-2">Dilengkapi berbagai fitur inovatif untuk meningkatkan produktivitas.</p>
              </div>
  
          </div>
      </div>
    </section>
  

    {{-- Section Fitur --}}
    <section x-data="{ 
        activeIndex: 0, 
        items: [
            { title: 'Kuis', description: 'Uji pemahaman kamu dengan kuis interaktif.', link: 'kuis.html', bg: 'bg-gradient-to-r from-blue-500 to-indigo-600' },
            { title: 'Materi', description: 'Pelajari konsep dasar hingga tingkat lanjut.', link: 'materi.html', bg: 'bg-gradient-to-r from-green-500 to-teal-600' },
            { title: 'Project Based Learning', description: 'Bangun proyek nyata dengan metode PBL.', link: 'pbl.html', bg: 'bg-gradient-to-r from-purple-500 to-pink-600' }
        ] 
    }" 
    x-init="setInterval(() => activeIndex = (activeIndex + 1) % items.length, 3000)" 
    class="w-full h-screen flex items-center justify-center transition-all duration-500 rounded-md mt-2"
    :class="items[activeIndex].bg">

        <!-- Kontainer utama -->
        <div class="max-w-4xl w-full text-center text-white p-10">

            <!-- Tampilkan fitur yang aktif -->
            <template x-for="(item, index) in items" :key="index">
                <a x-show="activeIndex === index" 
                   :href="item.link" 
                   class="block bg-white bg-opacity-20 backdrop-blur-md p-10 rounded-xl shadow-lg transform transition-all duration-500 hover:scale-105">
                    <h3 class="text-5xl font-bold" x-text="item.title"></h3>
                    <p class="text-lg mt-4" x-text="item.description"></p>
                </a>
            </template>

            <!-- Navigasi bulatan -->
            <div class="flex justify-center mt-6">
                <template x-for="(item, index) in items" :key="index">
                    <div @click="activeIndex = index" 
                         :class="activeIndex === index ? 'bg-white' : 'bg-gray-300'" 
                         class="w-4 h-4 mx-2 rounded-full cursor-pointer transition-all duration-300"></div>
                </template>
            </div>

        </div>

    </section>
    
      
</x-layout-siswa>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 3000,
        },
        spaceBetween: 20,
    });
</script>

