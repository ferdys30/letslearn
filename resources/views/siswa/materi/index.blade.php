<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
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
                <img src="https://tailwindui.com/plus-assets/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Dashboard Image" class="rounded-lg shadow-lg w-3/4 max-w-xs">
            </div>
        </div>
    </section>
    
  <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Materi Pelajaran {{ $mapel->nama_mapel }}</h1>

    <div class="flex" x-data="{ tab: 'materi0' }">
        <div class="w-1/4 space-y-2">
            @forelse($materi as $index => $item)
                <button @click="tab = 'materi{{ $index }}'"
                    :class="{ 'bg-purple-600 text-white': tab === 'materi{{ $index }}' }"
                    class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                    {{ $item->judul }}
                </button>
            @empty
                <p class="text-center text-gray-500 mt-4">Belum ada materi tersedia.</p>
            @endforelse
        </div>

        <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
            @forelse($materi as $index => $item)
                <div x-show="tab === 'materi{{ $index }}'">
                    <h2 class="text-xl font-semibold text-gray-700">{{ $item->urutan_materi }}</h2>
                    <p class="mt-2 text-gray-600">{{ $item->deskripsi_materi }}</p>

                    @if($item->dokumen_materi)
                        <div class="mt-4">
                            <iframe src="{{ asset('storage/dokumen_materi/' . $item->dokumen_materi) }}" class="w-full h-[500px] border rounded" frameborder="0"></iframe>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center text-gray-500">Belum ada konten materi yang dapat ditampilkan.</div>
            @endforelse
        </div>
    </div>

  </div>
</x-layout-siswa>
