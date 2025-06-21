<x-layout-guru>
    {{-- @dd($mapel) --}}
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Section: Deskripsi Mata Pelajaran -->
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mata Pelajaran {{ $mapel->nama_mapel }}</h1>
        <p class="text-gray-600 mt-1 flex justify-between items-center">
            {{ $mapel->deskripsi_mapel }}
            <button class="text-sm text-purple-600 hover:underline" onclick="editItem(1)">Edit</button>
        </p>
    </section>   
    

    {{-- Tujuan Pembelajaran --}}
    <section x-data="{ showModal: false }" class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-left mb-4">Tujuan Pembelajaran</h2>

        <div class="bg-white shadow-lg rounded-2xl p-6 w-full text-gray-800">
            <ul class="space-y-3 mb-6">
                @forelse($tujuan_pembelajaran as $index => $tp)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
                        <span>{{ $index + 1 }}. {{ $tp->tujuan_pembelajaran }}</span>
                        <button class="text-sm text-purple-600 hover:underline" onclick="editItem({{ $tp->id }})">Edit</button>
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
        <div 
            x-show="showModal" 
            x-transition 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Tujuan Pembelajaran</h2>
                    <button @click="showModal = false" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                </div>

                <form action="/store/tp" method="POST" class="space-y-4">
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
    </section>

    
    <!-- Tabel Indikator Penilaian -->
    <section x-data="{ showModal: false }" class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-3xl font-bold text-gray-800 text-left">Indikator Penilaian</h2>
            <button @click="showModal = true" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Indikator</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Indikator Penilaian</th>
                    <th>Aspek</th>
                    <th>Skala 1</th>
                    <th>Skala 2</th>
                    <th>Skala 3</th>
                    <th>Skala 4</th>
                    <th>Skala 5</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($indikator_penilaian as $i)
                    <tr>
                        <td>{{ $i->indikator_penilaian }}</td>
                        <td>
                            @switch($i->skema)
                                @case(1) Kognitif @break
                                @case(2) Psikomotorik @break
                                @case(3) Afektif @break
                                @default -
                            @endswitch
                        </td>
                        <td>{{ $i->skala_1 }}</td>
                        <td>{{ $i->skala_2 }}</td>
                        <td>{{ $i->skala_3 }}</td>
                        <td>{{ $i->skala_4 }}</td>
                        <td>{{ $i->skala_5 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah Indikator -->
        <div 
            x-show="showModal" 
            x-transition 
            x-cloak 
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
        >
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Indikator Penilaian</h3>
                    <form action="/store/indikator" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                    <div>
                        <label for="indikator_penilaian" class="block mb-2 text-sm font-medium text-gray-700">Indikator Penilaian</label>
                        <input type="text" name="indikator_penilaian" id="indikator_penilaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Masukkan indikator penilaian..." required>
                    </div>
                    <div>
                        <label for="skema" class="block mb-2 text-sm font-medium text-gray-700">Aspek</label>
                        <select name="skema" id="skema" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="1">Kognitif</option>
                            <option value="2">Psikomotorik</option>
                            <option value="3">Afektif</option>
                        </select>
                    </div>
                    <!-- Skala Penilaian (Textarea) -->
                    <div class="space-y-4">
                        <div>
                            <label for="skala_1" class="block text-sm font-medium text-gray-700">Skala 1</label>
                            <textarea name="skala_1" id="skala_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala 1" required></textarea>
                        </div>
                        <!-- Tambahkan skala 2, 3, 4, 5 -->
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="skala_2" class="block text-sm font-medium text-gray-700">Skala 2</label>
                            <textarea name="skala_2" id="skala_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala 1" required></textarea>
                        </div>
                        <!-- Tambahkan skala 2, 3, 4, 5 -->
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="skala_3" class="block text-sm font-medium text-gray-700">Skala 3</label>
                            <textarea name="skala_3" id="skala_3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala 1" required></textarea>
                        </div>
                        <!-- Tambahkan skala 2, 3, 4, 5 -->
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="skala_4" class="block text-sm font-medium text-gray-700">Skala 4</label>
                            <textarea name="skala_4" id="skala_4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala 1" required></textarea>
                        </div>
                        <!-- Tambahkan skala 2, 3, 4, 5 -->
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="skala_5" class="block text-sm font-medium text-gray-700">Skala 5</label>
                            <textarea name="skala_5" id="skala_5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala 1" required></textarea>
                        </div>
                        <!-- Tambahkan skala 2, 3, 4, 5 -->
                    </div>
    
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="toggleModal(false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>

                <button @click="showModal = false" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
            </div>
        </div>
    </section>

    
    <script>
        function toggleModal(isOpen) {
            const modal = document.getElementById('modalForm');
            modal.classList.toggle('hidden', !isOpen); 
        }
    </script>
    
    
    <!-- JS jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    
    <!-- JavaScript untuk menampilkan dan menyembunyikan modal -->
    <script>
        function toggleModal(isOpen) {
            const modal = document.getElementById('modalForm');
            modal.classList.toggle('hidden', !isOpen);
        }
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</x-layout-guru>
