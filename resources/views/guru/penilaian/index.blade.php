<x-layout-guru>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <section class="px-6 py-6 bg-white shadow-md rounded-md mb-6 border-b-4 border-purple-600">
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-bold mb-4">Penilaian Kelompok: {{ $kelompok->nama_kelompok_pjbl }}</h2>

            <table id="myTable" class="display">
                <thead>
                    <tr class="bg-gray-100">
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Nilai PJBL</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($anggota as $a)
    @php
        // Ambil nilai rata-rata dari indikator siklus ini
        $nilaiPjbl = $a->user->penilaians->sum('nilai');
    @endphp
    <tr>
        <td>{{ $a->user->nama }}</td>
        <td>{{ $a->posisi->nama_posisi }}</td>
        <td>
            {{ $nilaiPjbl ? number_format($nilaiPjbl, 2) : 'Belum dinilai' }}
        </td>
        <td class="text-center">
            @if(!$nilaiPjbl)
                <button 
                    onclick="openPenilaianModal({{ $a->id }}, '{{ $a->user->nama }}', '{{ $a->posisi->nama_posisi }}')"
                    class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">
                    Nilai
                </button>
            @else
                <span class="text-green-600 font-semibold">✅ Sudah dinilai</span>
            @endif
        </td>
    </tr>
@endforeach
</tbody>

            </table>
        </div>
    </section>


    <!-- Modal Penilaian -->
    <div id="penilaianModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-6xl p-10 rounded-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-xl font-semibold mb-4">Tambah Penilaian</h3>
            <form action="{{ route('guru.penilaian.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_user" id="modalUserId">

                <div class="mb-4">
                    <label>Nama</label>
                    <input type="text" id="modalNama" disabled class="w-full bg-gray-100 rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label>Posisi</label>
                    <input type="text" id="modalPosisi" disabled class="w-full bg-gray-100 rounded px-3 py-2">
                </div>

                <!-- ✅ Tabel Indikator -->
                <div id="indikatorContainer" class="mb-6"></div>

                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closePenilaianModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        function openPenilaianModal(anggotaId, nama, posisi) {
            const anggota = @json($anggota);
            const indikator = @json($indikator); // ✅ ambil indikator dari variabel global
            const selected = anggota.find(a => a.id == anggotaId);

            if (!selected) return;

            document.getElementById('modalUserId').value = selected.user.id;
            document.getElementById('modalNama').value = nama;
            document.getElementById('modalPosisi').value = posisi;

            const indikatorContainer = document.getElementById('indikatorContainer');
            indikatorContainer.innerHTML = `
                <table class="w-full border border-gray-300 rounded-lg text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Indikator</th>
                            <th class="border px-3 py-2 text-left">Skala 1</th>
                            <th class="border px-3 py-2 text-left">Skala 2</th>
                            <th class="border px-3 py-2 text-left">Skala 3</th>
                            <th class="border px-3 py-2 text-left">Skala 4</th>
                            <th class="border px-3 py-2 text-center">Nilai Maks</th>
                            <th class="border px-3 py-2 text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${indikator.map(ind => `
                            <tr>
                                <td class="border px-3 py-2">${ind.indikator_penilaian}</td>
                                <td class="border px-3 py-2">${ind.skala_1}</td>
                                <td class="border px-3 py-2">${ind.skala_2}</td>
                                <td class="border px-3 py-2">${ind.skala_3}</td>
                                <td class="border px-3 py-2">${ind.skala_4}</td>
                                <td class="border px-3 py-2 text-center font-semibold">${ind.nilai_maks}</td>
                                <td class="border px-3 py-2">
                                    <input type="hidden" name="indikator_ids[]" value="${ind.id}">
                                    <input 
                                        type="number" 
                                        name="nilai[${ind.id}]" 
                                        min="0" 
                                        max="${ind.nilai_maks}" 
                                        placeholder="0-${ind.nilai_maks}"
                                        class="w-24 border rounded px-2 py-1"
                                        required
                                    >
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;

            const modal = document.getElementById('penilaianModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePenilaianModal() {
            const modal = document.getElementById('penilaianModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-layout-guru>
