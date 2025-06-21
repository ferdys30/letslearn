<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <!-- STARTHERO -->
    <section class="container mx-auto px-6 lg:px-10 py-6">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between">
            <!-- Teks -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-4xl font-bold text-gray-800 leading-tight">
                    Kelas <span class="text-purple-600">{{ $mapel->nama_mapel }}</span>
                </h1>
                <p class="mt-4 text-gray-600">
                    {{ $mapel->deskripsi_mapel }}
                </p>
            </div>

            <!-- Gambar -->
            <div class="lg:w-1/2 flex justify-center lg:justify-end mt-8 lg:mt-0">
                <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-full max-w-md">
            </div>
        </div>
    </section>

    <div class="flex flex-wrap justify-center gap-6 p-6">

        <!-- Card Kuis -->
        <a href="/siswa/kelas/{{ $mapel->slug }}/kuis" class="max-w-lg w-full bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition block">
            <h3 class="text-xl font-semibold text-gray-800">Kuis</h3>
            <p class="text-gray-600 mt-2">Latih pemahaman dengan kuis interaktif yang menyesuaikan tingkat kesulitan berdasarkan jawaban Anda.</p>
        </a>

        <!-- Card Project-Based Learning -->
        <a href="/siswa/kelas/{{ $mapel->slug }}/project" class="max-w-lg w-full bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition block">
            <h3 class="text-xl font-semibold text-gray-800">Project-Based Learning</h3>
            <p class="text-gray-600 mt-2">Pelajari dengan metode berbasis proyek untuk meningkatkan keterampilan berpikir kritis dan kolaboratif.</p>
        </a>

        <!-- Card Materi -->
        <a href="/siswa/kelas/{{ $mapel->slug }}/materi" class="max-w-lg w-full bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition block">
            <h3 class="text-xl font-semibold text-gray-800">Materi</h3>
            <p class="text-gray-600 mt-2">Akses berbagai materi pembelajaran yang disusun secara sistematis untuk mendukung pemahaman yang mendalam.</p>
        </a>

    </div>


</x-layout>