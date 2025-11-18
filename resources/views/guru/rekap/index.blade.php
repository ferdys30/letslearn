<x-layout-guru>
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg" x-data="{ tab: 'sekarang' }">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Rekap Nilai {{ $mapel->nama_mapel }}</h1>

        {{-- Tombol Tab --}}
        <div class="flex gap-4 mb-6">
            <button @click="tab = 'sekarang'"
                :class="{ 'bg-green-600 text-white': tab === 'sekarang', 'bg-gray-200 text-gray-800': tab !== 'sekarang' }"
                class="px-4 py-2 rounded-lg shadow hover:bg-green-700 hover:text-white transition">
                Data Sekarang
            </button>
            <button @click="tab = 'history'"
                :class="{ 'bg-gray-600 text-white': tab === 'history', 'bg-gray-200 text-gray-800': tab !== 'history' }"
                class="px-4 py-2 rounded-lg shadow hover:bg-gray-700 hover:text-white transition">
                History
            </button>
        </div>

        {{-- Konten Tab --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
            {{-- Data Sekarang --}}
            <div x-show="tab === 'sekarang'">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Sekarang</h2>
                <div class="overflow-x-auto">
                    <table id="myTable1" class="display min-w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Kelas</th> {{-- ✅ Tambahan --}}
                                {{-- <th class="px-4 py-2 border">Rata-rata</th> --}}

                                {{-- Kolom Kuis --}}
                                @foreach ($kuisList as $kuis)
                                    <th class="px-4 py-2 border">Kuis {{ $kuis->judul }}</th>
                                @endforeach

                                {{-- Kolom Siklus --}}
                                @foreach ($siklusList as $siklus)
                                    <th class="px-4 py-2 border">PJBL {{ $siklus->nama_siklus_pjbl }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSekarang as $s)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $s->nama }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $s->kelas->Kelas ?? '-' }} {{ $s->jurusan ?? '' }}-{{ $s->paralel ?? '' }}
                                    </td>
                                    {{-- <td class="px-4 py-2 border text-center">
                                        {{ $s->penilaians->sum('nilai') ?? '-' }}
                                    </td> --}}

                                    {{-- Nilai Kuis --}}
                                    @foreach ($kuisList as $kuis)
                                        @php
                                            // Ambil penilaian untuk kuis ini dan siswa ini
                                            $penilaianKuis = $s->penilaians->where('id_kuis', $kuis->id)->first();
                                            $nilaiKuis = $penilaianKuis->nilai ?? '-';
                                            $fileJawaban = $penilaianKuis->file_jawaban ?? null;
                                        @endphp

                                        <td class="px-4 py-2 border text-center">
                                            @if ($fileJawaban)
                                                <a href="{{ asset('storage/' . $fileJawaban) }}" target="_blank"
                                                    class="text-blue-600 hover:underline">
                                                    {{ $nilaiKuis }}
                                                </a>
                                            @else
                                                {{ $nilaiKuis }}
                                            @endif
                                        </td>
                                    @endforeach


                                    {{-- Nilai Siklus --}}
                                    @foreach ($siklusList as $siklus)
                                        @php
                                            $nilaiSiklus = $s->penilaians
                                                ->filter(
                                                    fn($p) => optional($p->indikator)->id_siklus_pjbl == $siklus->id,
                                                )
                                                ->sum('nilai');
                                        @endphp
                                        <td class="px-4 py-2 border text-center">
                                            <a href="{{ route('guru.rekap.detail.siklus', [
                                                'slug' => $mapel->slug,
                                                'idSiswa' => $s->id,
                                                'idSiklus' => $siklus->id,
                                            ]) }}"
                                                class="text-blue-600 hover:underline">
                                                {{ $nilaiSiklus ?? '-' }}
                                            </a>
                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- Data History --}}
            <div x-show="tab === 'history'">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Data History</h2>
                <div class="overflow-x-auto">
                    <table id="myTable2" class="display min-w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Kelas</th> {{-- ✅ Tambahan --}}
                                {{-- <th class="px-4 py-2 border">Rata-rata</th> --}}

                                {{-- Kolom Kuis --}}
                                @foreach ($kuisList as $kuis)
                                    <th class="px-4 py-2 border">Kuis {{ $kuis->judul }}</th>
                                @endforeach

                                {{-- Kolom Siklus --}}
                                @foreach ($siklusList as $siklus)
                                    <th class="px-4 py-2 border">Siklus {{ $siklus->nama_siklus_pjbl }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataHistory as $s)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $s->nama }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $s->kelas->Kelas ?? '-' }} {{ $s->jurusan ?? '' }}-{{ $s->paralel ?? '' }}
                                    </td>
                                    {{-- <td class="px-4 py-2 border text-center">
                                        {{ $s->penilaians->sum('nilai') ?? '-' }}
                                    </td> --}}


                                    @foreach ($kuisList as $kuis)
                                        @php
                                            $nilaiKuis = $s->penilaians->where('id_kuis', $kuis->id)->sum('nilai');
                                        @endphp
                                        <td class="px-4 py-2 border text-center">
                                            {{ $nilaiKuis ?? '-' }}
                                        </td>
                                    @endforeach

                                    @foreach ($siklusList as $siklus)
                                        @php
                                            $nilaiSiklus = $s->penilaians
                                                ->filter(
                                                    fn($p) => optional($p->indikator)->id_siklus_pjbl == $siklus->id,
                                                )
                                                ->sum('nilai');
                                        @endphp
                                        <td class="px-4 py-2 border text-center">
                                            <a href="{{ route('guru.rekap.detail.siklus', [
                                                'slug' => $mapel->slug,
                                                'idSiswa' => $s->id,
                                                'idSiklus' => $siklus->id,
                                            ]) }}"
                                                class="text-blue-600 hover:underline">
                                                {{ $nilaiSiklus ?? '-' }}
                                            </a>
                                        </td>
                                    @endforeach


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery & DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable({
                pageLength: 10
            });
            $('#myTable2').DataTable({
                pageLength: 10
            });
        });
    </script>
</x-layout-guru>
