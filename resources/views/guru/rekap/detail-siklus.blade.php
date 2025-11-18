<x-layout-guru>
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">
            📋 Detail Nilai Siklus {{ $siklus->nama_siklus_pjbl }}
        </h1>

        <div class="mb-4">
            <p><strong>Nama Siswa:</strong> {{ $siswa->nama }}</p>
            <p><strong>Kelas:</strong> {{ $siswa->kelas->Kelas ?? '-' }} {{ $siswa->jurusan ?? '' }}{{ $siswa->paralel ? '-' . $siswa->paralel : '' }}</p>
            <p><strong>Mata Pelajaran:</strong> {{ $mapel->nama_mapel }}</p>
        </div>

        <div class="mb-6 border-t border-gray-300 pt-4">
            <h2 class="text-lg font-semibold mb-2">Detail Penilaian Aktivitas</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Aktivitas</th>
                            <th class="px-4 py-2 border">Nilai Siswa</th>
                            <th class="px-4 py-2 border text-center">Nilai Maksimal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penilaians as $i => $p)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border text-center">{{ $i + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $p->indikator->indikator_penilaian ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center font-semibold text-blue-700">{{ $p->nilai }}</td>
                                <td class="px-4 py-2 border text-center">{{ $p->indikator->nilai_maks ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div>
                <p class="text-gray-700 font-semibold">Total Nilai: <span class="text-blue-600">{{ $totalNilai }}</span></p>
                <p class="text-gray-700 font-semibold">Rata-Rata: <span class="text-green-600">{{ $rataRata }}</span></p>
            </div>
            <a href="{{ url()->previous() }}"
                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                ← Kembali
            </a>
        </div>
    </div>
</x-layout-guru>
