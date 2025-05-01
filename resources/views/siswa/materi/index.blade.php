<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
  <section class="container mx-auto px-6 lg:px-10 py-6">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between">
            <!-- Teks -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-4xl font-bold text-gray-800 leading-tight">
                    Kelas <span class="text-purple-600">Pemograman Website</span>
                </h1>
                <p class="mt-4 text-gray-600">
                    Pelajari cara membangun website interaktif menggunakan HTML, CSS, dan JavaScript.
                </p>
            </div>
            <!-- Gambar -->
            <div class="lg:w-1/2 flex justify-center lg:justify-end mt-8 lg:mt-0">
                <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-3/4 max-w-xs">
            </div>
        </div>
    </section>
    
  <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800">Materi Pelajaran Pemrograman Website</h1>

    <div class="flex mt-6" x-data="{ tab: 'materi1' }">
        <!-- Sidebar Navigasi -->
        <div class="w-1/4 space-y-2">
            <button @click="tab = 'materi1'" :class="{ 'bg-purple-600 text-white': tab === 'materi1' }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                HTML Dasar
            </button>
            <button @click="tab = 'materi2'" :class="{ 'bg-purple-600 text-white': tab === 'materi2' }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                CSS Layout
            </button>
            <button @click="tab = 'materi3'" :class="{ 'bg-purple-600 text-white': tab === 'materi3' }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Materi 3
            </button>
            <button @click="tab = 'materi4'" :class="{ 'bg-purple-600 text-white': tab === 'materi4' }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Materi 4
            </button>
            <button @click="tab = 'materi5'" :class="{ 'bg-purple-600 text-white': tab === 'materi5' }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Materi 5
            </button>
        </div>

        <!-- Konten Tab -->
        <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
            <div x-show="tab === 'materi1'">
                <h2 class="text-xl font-semibold text-gray-700">HTML Dasar</h2>
                <p class="mt-2 text-gray-600">Isi materi 1...</p>
            </div>

            <div x-show="tab === 'materi2'">
                <h2 class="text-xl font-semibold text-gray-700">HTML Dasar</h2>
                <p class="mt-2 text-gray-600">Isi materi 2...</p>
            </div>

            <div x-show="tab === 'materi3'">
                <h2 class="text-xl font-semibold text-gray-700">Materi 3</h2>
                <p class="mt-2 text-gray-600">Isi materi 3...</p>
            </div>

            <div x-show="tab === 'materi4'">
                <h2 class="text-xl font-semibold text-gray-700">Materi 4</h2>
                <p class="mt-2 text-gray-600">Isi materi 4...</p>
            </div>

            <div x-show="tab === 'materi5'">
                <h2 class="text-xl font-semibold text-gray-700">Materi 5</h2>
                <p class="mt-2 text-gray-600">Isi materi 5...</p>
            </div>
        </div>
    </div>
  </div>
</x-layout-siswa>
