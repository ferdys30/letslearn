<x-layout-guru>
    
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    {{-- Cek jika ada flash message untuk alert --}}
    @if (session('pengumpulan_tugas_alert'))
        <div class="mt-2 mb-2 p-4 rounded-md bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800">
            <strong class="font-semibold">Perhatian!</strong> {{ session('pengumpulan_tugas_alert') }}
            @php
                session()->forget('pengumpulan_tugas_alert');
            @endphp
        </div>
    @endif

         
    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 w-full border-b-4 border-purple-600">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ __('guru.Pengaturan_Mata_Pelajaran') }}</h2>
        <h3 class="text-2xl text-purple-700 font-semibold">{{ $mapel->nama_mapel }}</h3>
        <p class="text-gray-600 mb-8">{{ $mapel->deskripsi_mapel }}</p>
{{-- @dd($mapel) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('guru.mapel.detail', ['mapel' => $mapel->slug]) }}"
            class="bg-purple-700 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-purple-800 transition flex items-center justify-center">
                📋 {{ __('guru.Detail_Pelajaran') }}
            </a>

            <a href="{{ route('guru.pertemuan', ['mapel' => $mapel->slug]) }}"
            class="bg-purple-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-purple-700 transition flex items-center justify-center">
                🔣 {{ __('guru.Pertemuan') }}
            </a>

            <a href="{{ route('guru.materi', ['mapel' => $mapel->slug]) }}"
            class="bg-white text-purple-700 border border-purple-700 text-base px-4 py-3 rounded-lg shadow hover:bg-purple-700 hover:text-white transition flex items-center justify-center">
                📖 {{ __('guru.Materi') }}
            </a>

            <a href="{{ route('guru.kuis', ['mapel' => $mapel->slug]) }}"
            class="bg-black text-white text-base px-4 py-3 rounded-lg shadow hover:bg-gray-800 transition flex items-center justify-center">
                📝 {{ __('guru.Kuis') }}
            </a>
           <a href="{{ route('guru.rekap', ['mapel' => $mapel->slug]) }}"
            class="col-span-full bg-green-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-green-700 transition flex items-center justify-center w-full">
                📊 {{ __('guru.Rekap_Nilai') }}
            </a>


        </div>

    </section>

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6">
        <div class="flex justify-end mb-4">
            <button 
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded" 
                onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            >
                {{ __('guru.Tambah_Siklus_PJBL') }}
            </button>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 text-left">{{ __('guru.Data_Tugas_Project_Based_Learning') }} {{ $mapel->nama_mapel }}</h2>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>{{ __('guru.Nama_PJBL') }}</th>
                    <th>{{ __('guru.Deskripsi') }}</th>
                    <th>{{ __('guru.Tanggal_Mulai') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siklus_pjbls as $pjbl)
                    <tr onclick="window.location='{{ route('guru.siklus', ['mapel' => $mapel->slug, 'siklus_pjbl' => $pjbl->slug]) }}'" 
                        class="hover:bg-gray-100 cursor-pointer transition duration-200">
                        <td>
                                {{ $pjbl->nama_siklus_pjbl }}
                        </td>
                        <td>
                            {{ $pjbl->deskripsi }}
                        </td>
                        <td>
                            {{ $pjbl->tanggal_mulai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">{{ __('guru.Tambah_Siklus_PJBL') }}</h3>
            <form action="{{ route('guru.siklus_pjbls.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('guru.Nama_Siklus_PJBL') }}</label>
                    <input type="text" name="nama_siklus_pjbl" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('guru.Deskripsi') }}</label>
                    <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('guru.Tanggal_Mulai') }}</label>
                    <input type="date" name="tanggal_mulai" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('guru.Tanggal_Selesai') }}</label>
                    <input type="date" name="tanggal_selesai" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="button" 
                            class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2" 
                            onclick="document.getElementById('modalTambah').classList.add('hidden')">
                        {{ __('guru.Batal') }}
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        {{ __('guru.Simpan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- JS jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
        
    </script>
    <script>
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('modalTambah');
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
    
</x-layout-guru>
