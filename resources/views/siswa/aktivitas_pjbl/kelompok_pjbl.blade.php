<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

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


@if(session('error'))
    <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
        {{ session('error') }}
    </div>
@endif
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Kelompok Pembelajaran {{ $siklus_pjbl->nama_siklus_pjbl }}</h2>
            @if (!$userkelompok_pjbl)
                <button onclick="toggleModal(true)" class="bg-purple-600 text-white pr-4 pl-2 py-2 rounded-md hover:bg-purple-700 transition">+ Tambah Kelompok</button>
            @endif
        </div>
        <table id="myTable" class="display w-full table-auto text-sm">
            <thead class="bg-gray-200">
                <tr>
                    {{-- <th class="px-4 py-2 text-left font-semibold text-gray-800">Urutan kelompok_pjbl</th> --}}
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Nama Kelompok Pembelajaran</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Maksimal Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Nama Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Jumlah Anggota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Opsi</th>
                </tr>
            </thead>
            
            <tbody class="bg-white">
                 @foreach ($kelompok_pjbl as $klmpk)
                    @php
                        $count = $anggota->where('id_kelompok_pjbl', $klmpk->id)->count();
                        $progress = round($count / $klmpk->jumlah_kelompok_pjbl * 100);
                        $progressColor = $progress >= 100 ? 'bg-green-600' : 'bg-blue-600';
                    @endphp
                    <tr>
                        <td>{{ $klmpk->nama_kelompok_pjbl }}</td>
                        <td>{{ $klmpk->jumlah_kelompok_pjbl }}</td>
                        <td>
                            <ol>@foreach ($anggota->where('id_kelompok_pjbl', $klmpk->id) as $item)
                                <li>{{ $item->user->nama }}</li>
                            @endforeach</ol>
                        </td>
                        <td>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="{{ $progressColor }} h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <small>{{ $count }}/{{ $klmpk->jumlah_kelompok_pjbl }} ({{ $progress }}%)</small>
                        </td>
                        <td class="text-center">
                            @if ($userkelompok_pjbl === $klmpk->id && $count == $klmpk->jumlah_kelompok_pjbl && $klmpk->studi_kasus->isNotEmpty())
                                <a href="{{ route('siswa.kelas.siklus_pjbl.show', [
                                    'mapel' => $mapel->slug,
                                    'siklus_pjbl' => $klmpk->siklus_pjbl->slug // ❗ lebih baik pakai slug
                                ]) }}" 
                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                    Lihat Tugas
                                </a>
                            @elseif (!$userkelompok_pjbl && $count < $klmpk->jumlah_kelompok_pjbl)
                                <button onclick="bukaModalGabung({{ $klmpk->id }})" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Gabung Kelompok
                                </button>
                                <!-- Modal Gabung kelompok_pjbl -->
                                <div id="modalGabung" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded-lg w-full max-w-md">
                                        <h2 class="text-lg font-bold mb-4">Pilih Posisi</h2>
                                        <form id="formGabung" method="POST" action="{{ route('siswa.kelas.aktivitas_pjbl.kelompok_pjbl.gabung') }}">
                                            @csrf
                                            <input type="hidden" name="id_kelompok_pjbl" id="id_kelompok_pjbl_input">

                                            <div class="mb-4">
                                                <label for="id_posisi" class="block mb-1 font-medium">Posisi dalam kelompok_pjbl</label>
                                                <select name="id_posisi" id="id_posisi" class="w-full border rounded px-3 py-2" required>
                                                    <option value="">-- Pilih Posisi --</option>
                                                    @foreach ($posisi as $itemPosisi)
                                                        @continue($itemPosisi->id === 1 || strtolower($itemPosisi->nama_posisi) === 'ketua')
                                                        <option value="{{ $itemPosisi->id }}">{{ $itemPosisi->nama_posisi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="flex justify-end gap-2">
                                                <button type="button" onclick="tutupModalGabung()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Gabung</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @elseif (!$userkelompok_pjbl)
                                <span class="italic text-gray-500">Penuh</span>
                            @else
                                <span class="italic text-gray-500">Ditunggu...</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Kelompok</h3>

            <form action="{{ route('siswa.kelas.aktivitas_pjbl.kelompok_pjbl.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
                <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus_pjbl->id }}">
                <!-- Nama kelompok_pjbl -->
                <div>
                    <label for="nama_kelompok_pjbl" class="block mb-2 text-sm font-medium text-gray-900">Nama kelompok_pjbl</label>
                    <input type="text" name="nama_kelompok_pjbl" id="nama_kelompok_pjbl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: kelompok_pjbl A" required>
                </div>

                <!-- Jumlah kelompok_pjbl -->
                <div>
                    <label for="jumlah_kelompok_pjbl" class="block mb-2 text-sm font-medium text-gray-900">Jumlah kelompok_pjbl</label>
                    <input type="number" name="jumlah_kelompok_pjbl" id="jumlah_kelompok_pjbl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Contoh: 5" required>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleModal(false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                </div>
            </form>

            <!-- Tombol Close -->
            <button onclick="toggleModal(false)" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-lg font-bold">&times;</button>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        function toggleModal(show) {
            const modal = document.getElementById('modalForm');
            modal.classList.toggle('hidden', !show);
        }
    </script>
    <script>
        function bukaModalGabung(idkelompok_pjbl) {
            document.getElementById('modalGabung').classList.remove('hidden');
            document.getElementById('id_kelompok_pjbl_input').value = idkelompok_pjbl;
        }

        function tutupModalGabung() {
            document.getElementById('modalGabung').classList.add('hidden');
        }
    </script>

</x-layout-siswa>
