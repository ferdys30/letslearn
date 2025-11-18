<x-layout-guru>
    <div class="bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Paralel di Kelas {{ $kelas->Kelas }}</h2>

        @if ($paralels->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($paralels as $paralel)
                    <div class="bg-gray-100 rounded-md shadow p-4 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-700">Paralel {{ $paralel->paralel }}</h3>
                            <p class="text-sm text-gray-600">Jumlah Siswa: {{ $paralel->jumlah }}</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.kelas.naikkan', ['kelas' => $kelas->id]) }}?paralel={{ $paralel->paralel }}"
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                Lihat Siswa
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Belum ada paralel atau siswa pada kelas ini.</p>
        @endif
    </div>
</x-layout-guru>
