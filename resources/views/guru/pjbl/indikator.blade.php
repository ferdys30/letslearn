<x-layout-guru>
    <!-- Tabel Indikator Penilaian -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <section 
        x-data="{
            showModal: false,
            showEditModal: false,
            editId: null,
            editForm: {
                indikator_penilaian: '',
                skema: '',
                nilai_maks: '',
                skala_1: '',
                skala_2: '',
                skala_3: '',
                skala_4: ''
            },
            openEditModal(data) {
                console.log('DATA DITERIMA:', data); // 🔎 Debug
                this.editId = data.id;
                this.editForm = { ...data };
                this.showEditModal = true;
            }
        }"

        class="px-6 py-6 bg-white shadow-md rounded-md mb-6"
    >
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-3xl font-bold text-gray-800 text-left">Indikator Penilaian</h2>
            <button @click="showModal = true" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Indikator</button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Indikator Penilaian</th>
                    <th>Aspek</th>
                    <th>Nilai Maks</th>
                    <th>Skala 1</th>
                    <th>Skala 2</th>
                    <th>Skala 3</th>
                    <th>Skala 4</th>
                    {{-- <th>Skala 5</th> --}}
                    <th>Aksi</th>
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
                        <td>{{ $i->nilai_maks }}</td>
                        <td>{{ $i->skala_1 }}</td>
                        <td>{{ $i->skala_2 }}</td>
                        <td>{{ $i->skala_3 }}</td>
                        <td>{{ $i->skala_4 }}</td>
                        {{-- <td>{{ $i->skala_5 }}</td> --}}
                        <td>
                            <div class="flex space-x-3">
                               <!-- Tombol Edit -->
                                {{-- <button 
                                    type="button"
                                    data-id="{{ $i->id }}"
                                    data-indikator="{{ $i->indikator_penilaian }}"
                                    data-skema="{{ $i->skema }}"
                                    data-nilai_maks="{{ $i->nilai_maks }}"
                                    data-skala_1="{{ $i->skala_1 }}"
                                    data-skala_2="{{ $i->skala_2 }}"
                                    data-skala_3="{{ $i->skala_3 }}"
                                    data-skala_4="{{ $i->skala_4 }}"
                                    @click="
                                        openEditModal({
                                            id: $el.dataset.id,
                                            indikator_penilaian: $el.dataset.indikator,
                                            skema: $el.dataset.skema,
                                            nilai_maks: $el.dataset.nilai_maks,
                                            skala_1: $el.dataset.skala_1,
                                            skala_2: $el.dataset.skala_2,
                                            skala_3: $el.dataset.skala_3,
                                            skala_4: $el.dataset.skala_4,
                                        })
                                    "
                                >
                                    Edit
                                </button> --}}

                                <form 
                                    method="POST" 
                                    action="{{ route('guru.indikator.delete', $i->id) }}" 
                                    onsubmit="return confirm('Yakin ingin menghapus indikator ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah Indikator -->
        <div x-show="showModal" x-transition x-cloak class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Indikator Penilaian</h3>
                <form action="{{ route('guru.indikator.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                    <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus->id }}">
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
                    {{-- <div>
                        <label for="id_posisi" class="block mb-2 text-sm font-medium text-gray-700">Posisi</label>
                        <select name="id_posisi" id="id_posisi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                            <option value="">-- Pilih Posisi --</option>
                            @foreach ($posisi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_posisi }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div>
                        <label for="nilai_maks" class="block mb-2 text-sm font-medium text-gray-700">Nilai Maksimum</label>
                        <input type="text" name="nilai_maks" id="nilai_maks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Masukkan Nilai Maksimum..." required>
                    </div>
                    @for ($i = 1; $i <= 4; $i++)
                        <div>
                            <label for="skala_{{ $i }}" class="block text-sm font-medium text-gray-700">Skala {{ $i }}</label>
                            <textarea name="skala_{{ $i }}" id="skala_{{ $i }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" rows="3" placeholder="Masukkan deskripsi skala {{ $i }}" required></textarea>
                        </div>
                    @endfor
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
                <button @click="showModal = false" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
            </div>
        </div>

        {{-- modaledit --}}
        {{-- <div 
            x-show="showEditModal" 
            x-transition 
            x-cloak 
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
        >
            <div 
                @click.away="showEditModal = false" 
                class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-[80vh] overflow-y-auto"
            >
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Indikator Penilaian</h3>
                
                <form :action="`{{ url('/guru/indikator/update') }}/${editId}`" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Indikator Penilaian</label>
                        <input type="text" name="indikator_penilaian" x-model="editForm.indikator_penilaian" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Aspek</label>
                        <select name="skema" x-model="editForm.skema" class="w-full border rounded p-2">
                            <option value="1">Kognitif</option>
                            <option value="2">Psikomotorik</option>
                            <option value="3">Afektif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nilai Maksimum</label>
                        <input type="text" name="nilai_maks" x-model="editForm.nilai_maks" class="w-full border rounded p-2">
                    </div>

                    <template x-for="i in 4" :key="i">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skala <span x-text="i"></span></label>
                            <textarea :name="'skala_' + i" x-model="editForm['skala_' + i]" class="w-full border rounded p-2"></textarea>
                        </div>
                    </template>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
                
                <button @click="showEditModal = false" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
            </div>
        </div> --}}



    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('indikatorApp', () => ({
            showEditModal: false,
            editForm: {
                id: null,
                indikator_penilaian: '',
                skema: '',
                nilai_maks: '',
                skala_1: '',
                skala_2: '',
                skala_3: '',
                skala_4: ''
            },
            openEditModal(data) {
                this.editForm = data;
                this.showEditModal = true;
            }
        }))
    })
</script>

</x-layout-guru>