<x-layout-guru>
    <!-- Tambahkan CSS untuk x-cloak -->
    <style>[x-cloak] { display: none !important; }</style>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Section: Deskripsi Mata Pelajaran -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <h1 class="text-2xl font-bold text-gray-800">Mata Pelajaran {{ $mapel->nama_mapel }}</h1>
        <div class="text-gray-600 mt-1 flex justify-between items-start">
            <p class="w-11/12">{{ $mapel->deskripsi_mapel }}</p>

            <div x-data="{ openEditModal: false }" x-cloak>
                <button @click="openEditModal = true" class="text-sm text-purple-600 hover:underline ml-4">
                    Edit
                </button>

                <!-- Modal -->
                <div x-show="openEditModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div @click.away="openEditModal = false" class="bg-white p-6 rounded-md shadow-lg w-11/12 md:w-1/2">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Edit Deskripsi Mapel</h2>
                            <button @click="openEditModal = false" class="text-gray-600 text-2xl">&times;</button>
                        </div>

                        <form method="POST" action="{{ route('guru.mapel.update', $mapel->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="deskripsi_mapel" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea 
                                    name="deskripsi_mapel" 
                                    id="deskripsi_mapel" 
                                    rows="4" 
                                    required
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-purple-500 focus:border-purple-500"
                                >{{ old('deskripsi_mapel', $mapel->deskripsi_mapel) }}</textarea>
                            </div>

                            <div class="flex justify-end gap-2">
                                <button 
                                    type="button" 
                                    @click="openEditModal = false" 
                                    class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400"
                                >
                                    Batal
                                </button>
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700"
                                >
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Tujuan Pembelajaran -->
    <section x-data="{ showModal: false, showEditModal: false, editId: null, editText: '' }" class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left mb-4">Tujuan Pembelajaran</h2>

        <div class="bg-white shadow-lg rounded-2xl p-6 w-full text-gray-800">
            <ul class="space-y-3 mb-6">
                @forelse($tujuan_pembelajaran as $index => $tp)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
                        <span>{{ $index + 1 }}. {{ $tp->tujuan_pembelajaran }}</span>
                        <button 
                            class="text-sm text-purple-600 hover:underline"
                            @click="showEditModal = true; editId = {{ $tp->id }}; editText = `{{ $tp->tujuan_pembelajaran }}`"
                        >
                            Edit
                        </button>
                    </li>
                @empty
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
                        <span class="italic text-gray-500">Belum ada tujuan pembelajaran.</span>
                    </li>
                @endforelse

                <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
                    <span class="text-gray-500 italic">+ Tambah Data</span>
                    <button @click="showModal = true" class="text-sm text-green-600 hover:underline font-medium">Tambah</button>
                </li>
            </ul>
        </div>

        <!-- Modal Tambah Tujuan -->
        <div x-show="showModal" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Tujuan Pembelajaran</h2>
                    <button @click="showModal = false" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                </div>

                <form action="{{ route('guru.tp.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                    <div>
                        <label for="tujuan_pembelajaran" class="block text-sm font-medium text-gray-700">Tujuan Pembelajaran</label>
                        <textarea name="tujuan_pembelajaran" id="tujuan_pembelajaran" rows="3" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Masukkan tujuan pembelajaran..."></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Tujuan -->
        <div x-show="showEditModal" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Tujuan Pembelajaran</h2>
                    <button @click="showEditModal = false" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                </div>

                <form :action="`/guru/tp/update/${editId}`" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="edit_tujuan" class="block text-sm font-medium text-gray-700">Tujuan Pembelajaran</label>
                        <textarea x-model="editText" name="tujuan_pembelajaran" id="edit_tujuan" rows="3" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        ></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
</x-layout-guru>
