<x-navbar-siswa></x-navbar-siswa>

<style>
    /* Custom scrollbar hanya untuk div tertentu */
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #9333ea;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #e5e7eb;
    }
</style>

<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
{{-- 
    <div class="w-full overflow-x-auto custom-scrollbar scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-200 hover:scrollbar-thumb-purple-700">
        <div class="flex w-[150%] md:w-full space-x-4 px-4 py-2 relative">
            @foreach ($semua_pjbl as $index => $item)
                @php
                    $isCompleted = in_array($item->id, $pjbl_terkumpul);
                    $isCurrent = $item->id === $pjbl->id;
                    $stepNumber = $index + 1;
                @endphp

                <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold
                        border-2
                        {{ $isCompleted ? 'bg-purple-500 text-white border-purple-500' : ($isCurrent ? 'text-purple-700 border-purple-700 bg-purple-100' : 'text-purple-400 border-purple-500') }}">
                        {{ $isCompleted ? '✔' : $stepNumber }}
                    </div>

                    <p class="text-sm font-bold mt-2 text-center 
                        {{ $isCompleted ? 'text-gray-800' : ($isCurrent ? 'text-purple-700' : 'text-purple-500') }}">
                        {{ ucwords(str_replace('-', ' ', $item->slug)) }}
                    </p>

                    <p class="text-xs text-gray-500 text-center">
                        {{ $item->penjelasan ?? 'Deskripsi belum diisi' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div> --}}

    <div class="w-full h-300 bg-white shadow-md rounded-none p-8 mt-2 relative">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $pjbl->nama_syntax }}: {{ $pjbl->mata_pelajaran->nama_mapel }}</h2>
            <div id="countdown-timer" class="bg-gray-800 text-white px-4 py-2 rounded shadow">
                Sisa waktu: {{ floor($pjbl->waktu / 60) }}:{{ str_pad($pjbl->waktu % 60, 2, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        @foreach ($studi_kasus as $kasus)
            <p class="text-gray-700 text-lg leading-relaxed max-w-4xl">
                {{ $kasus->studi_kasus }}
            </p>
        @endforeach


        <form id="form-pengumpulan" action="/pengumpulan/syntax" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- @dd($next_slug) --}}
            <input type="hidden" name="id_kelompok" value="{{ $kelompokUser->id_kelompok }}">
            <input type="hidden" name="id_pjbl" value="{{ $pjbl->id }}">
            <input type="hidden" name="id_user" value="{{ Auth::id() }}">
            {{-- <input type="hidden" name="next_slug" value="{{ $next_slug }}"> --}}

            @if ($pjbl->pengumpulan == 1)
                <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-700">Jawaban:</label>
                <textarea name="deskriptif" id="jawaban" rows="5"
                          class="w-full p-3 border rounded-lg focus:outline-none focus:ring"
                          placeholder="Tulis jawabanmu di sini..."></textarea>

            @elseif ($pjbl->pengumpulan == 2)
                <label for="file" class="block mb-2 text-sm font-medium text-gray-700">Upload File:</label>
                <input type="file" name="file_pengumpulan" id="file"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
            @endif

            @if ($pjbl->pengumpulan === 1 || $pjbl->pengumpulan === 2)
                <button type="submit" class="hidden">Submit</button>
            @endif
        </form>
    </div>

    <script>
    window.onload = function() {
        let waktu = @json($pjbl->waktu);
        let countdownElement = document.getElementById('countdown-timer');
        let form = document.getElementById('form-pengumpulan');

        if (!countdownElement) {
            console.error('Elemen countdown-timer tidak ditemukan');
            return;
        }

        if (!form) {
            console.error('Form pengumpulan tidak ditemukan');
            return;
        }

        let timer = setInterval(function () {
            let minutes = Math.floor(waktu / 60);
            let seconds = waktu % 60;

            countdownElement.textContent = `Sisa waktu: ${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (waktu <= 0) {
                clearInterval(timer);
                console.log('Waktu habis, submit form');
                form.submit(); // submit otomatis saat waktu habis
            }

            waktu--;
        }, 1000);
    };

    </script>
</x-layout-siswa>
