<x-layout-guru>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 w-full border-b-4 border-purple-600">
        <h2 class="text-3xl font-bold text-gray-800 mb-4"> {{ __('guru.Project_Based_Learning') }}
            {{ $mapel->nama_mapel }}</h2>
        <h3 class="text-2xl text-purple-700 font-semibold">{{ $siklus->nama_siklus_pjbl }}</h3>
        <p class="text-gray-600 mb-8">{{ $siklus->deskripsi }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <a href="{{ route('guru.indikator', ['mapel' => $mapel->slug, 'siklus_pjbl' => $siklus->slug]) }}"
                class="bg-purple-700 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-purple-800 transition flex items-center justify-center">
                📌 {{ __('guru.Indikator') }}
            </a>

            <a href="{{ route('guru.aktivitas_pjbl', ['mapel' => $mapel->slug, 'siklus_pjbl' => $siklus->slug]) }}"
                class="bg-purple-600 text-white text-base px-4 py-3 rounded-lg shadow hover:bg-purple-700 transition flex items-center justify-center">
                🏃 {{ __('guru.Aktivitas') }}
            </a>

            <a href="{{ route('guru.studi_kasus', ['mapel' => $mapel->slug, 'siklus_pjbl' => $siklus->slug]) }}"
                class="bg-white text-purple-700 border border-purple-700 text-base px-4 py-3 rounded-lg shadow hover:bg-purple-700 hover:text-white transition flex items-center justify-center">
                🧩 {{ __('guru.Studi_Kasus') }}
            </a>

            <a href="{{ route('guru.posisi', ['mapel' => $mapel->slug, 'siklus_pjbl' => $siklus->slug]) }}"
                class="bg-black text-white text-base px-4 py-3 rounded-lg shadow hover:bg-gray-800 transition flex items-center justify-center">
                🧩 {{ __('guru.Posisi') }}
            </a>
        </div>
    </section>

    {{-- Tabel Kelompok dengan Studi Kasus --}}
    <section class="px-6 py-6 bg-white shadow-md rounded-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('guru.Data_Kelompok') }}</h2>

        @if ($kelompoks->isEmpty())
            <p class="text-gray-500">{{ __('guru.BAKYMST') }}</p>
        @else
            <div class="overflow-x-auto">
                <table id="myTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ __('guru.Nama_Kelompok') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ __('guru.Jumlah_Anggota') }}
                            </th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-600 uppercase">
                                {{ __('guru.Studi_Kasus') }}</th>
                            @foreach ($aktivitas as $act)
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    {{ $act->nama_aktivitas }}
                                </th>
                            @endforeach

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ __('guru.Progress') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kelompoks as $kelompok)
                            <tr>
                                <td class="px-6 py-4 text-gray-900">
                                    <a href="{{ route('guru.penilaian', [
                                        'mapel_slug' => $mapel->slug,
                                        'siklus_slug' => $siklus->slug, // Menggunakan $siklus dari view sebelumnya
                                        'kelompok_id' => $kelompok->id,
                                    ]) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $kelompok->nama_kelompok_pjbl }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $kelompok->jumlah_anggota }}</td>
                                <td class="px-3 py-2 text-gray-700">
                                    @php
                                        $texts = $kelompok->studi_kasus->pluck('studi_kasus')->toArray();
                                        $fullText = implode(', ', $texts);
                                        $count = count($texts);
                                    @endphp

                                    <span title="{{ $fullText }}" class="underline cursor-help">
                                        {{ __('guru.Studi_Kasus') }}
                                    </span>
                                </td>

                                @foreach ($aktivitas as $act)
                                    @php
                                        $status = $kelompok->status_syntax[$act->id];
                                    @endphp

                                    <td class="px-6 py-4 text-center text-gray-700">
                                        @if ($status == 2)
                                            <span class="text-green-600 font-bold">✔️</span>
                                        @elseif ($status == 1)
                                            <span class="text-yellow-500 font-bold">⏳</span>
                                        @else
                                            <span class="text-gray-400 font-bold">❌</span>
                                        @endif
                                    </td>
                                @endforeach

                                <td class="px-3 py-4 text-gray-700">
                                    <a href="{{ route('guru.aktivitas_pjbl.kelompok_pjbl.detail', [
                                        // Ganti 'mapel' menjadi 'mapel_slug'
                                        'mapel_slug' => $mapel->slug,
                                        // Ganti 'kelompok_pjbl' menjadi 'kelompok_id'
                                        'kelompok_id' => $kelompok->id,
                                    ]) }}"
                                        class="block w-full">

                                        <div class="w-full bg-gray-200 rounded-full h-4 hover:opacity-80 transition">
                                            <div class="bg-green-500 h-4 rounded-full text-xs text-white text-center"
                                                style="width: {{ $kelompok->progress }}%;">
                                                {{ $kelompok->progress }}%
                                            </div>
                                        </div>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</x-layout-guru>
