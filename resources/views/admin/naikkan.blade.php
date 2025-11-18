<x-layout-guru>
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Naikkan Siswa dari Kelas {{ $kelas->Kelas }}</h2>

        <form action="{{ route('admin.kelas.prosesNaik') }}" method="POST" class="space-y-6">
            @csrf

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border rounded-md shadow-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <input type="checkbox" onclick="toggle(this)">
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIS</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Paralel</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswa as $s)
                            <tr>
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $s->id }}">
                                </td>
                                <td class="px-4 py-2 text-gray-700">{{ $s->nama }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $s->nis }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $s->paralel }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada siswa ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                <label for="kelas_tujuan" class="block text-sm font-semibold text-gray-700 mb-1">Naikkan ke kelas:</label>
                <select name="kelas_tujuan" id="kelas_tujuan"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($kelasTujuan as $kls)
                        <option value="{{ $kls->id }}">{{ $kls->Kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                    Naikkan Kelas
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggle(source) {
            const checkboxes = document.getElementsByName('siswa_id[]');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</x-layout-guru>
