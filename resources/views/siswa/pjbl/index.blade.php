<x-navbar-siswa></x-navbar-siswa>
    <!-- Tambahkan Style Tailwind untuk Scrollbar -->
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
    {{-- @dd($pjbl); --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 py-6">
        <!-- Card Siswa 1 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=1" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Rafi Ahmad</h3>
            <p class="text-sm text-gray-500">NIS: 210301</p>
            </div>
        </div>

        <!-- Card Siswa 2 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=2" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Dina Lestari</h3>
            <p class="text-sm text-gray-500">NIS: 210302</p>
            </div>
        </div>

        <!-- Card Siswa 3 -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
            <img src="https://i.pravatar.cc/60?img=3" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover">
            <div>
            <h3 class="text-md font-semibold text-gray-800">Alif Nur</h3>
            <p class="text-sm text-gray-500">NIS: 210303</p>
            </div>
        </div>
        </section>

    <div class="w-full overflow-x-auto custom-scrollbar scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-200 hover:scrollbar-thumb-purple-700">
        <div class="flex w-[150%] md:w-full space-x-4 px-4 py-2">
            <!-- Step 1 -->
            <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    1
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Membuat kelompok</p>
                <p class="text-xs text-gray-500 text-center">membuat rumusan masalah dan mencari indikator penyebab masalah</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 2 (Active) -->
            <div class="flex flex-col items-center min-w-[180px] p-4 relative">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    2
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Menyusun Rencana Proyek</p>
                <p class="text-xs text-gray-500 text-center">Mempersiapkan rencana pengerjaan proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 3 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    3
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Proyek Dibagikan</p>
                <p class="text-xs text-gray-500 text-center">Memastikan proyek telah dibagi</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 4 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    4
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Progres Pengerjaan</p>
                <p class="text-xs text-gray-500 text-center">Siswa Melaksanakan Tugas sesuai Jadwal</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 5 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    5
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Pengumpulan Proyek</p>
                <p class="text-xs text-gray-500 text-center">Mengumpulkan hasil proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 6 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    6
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Kelompok Presentasi</p>
                <p class="text-xs text-gray-500 text-center">Memaparkan hasil proyek</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 7 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    7
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2 text-center">Evaluasi & perbaikan</p>
                <p class="text-xs text-gray-500 text-center">Pemberian evaluasi dan perbaikan projeck</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
    
            <!-- Step 8 -->
            <div class="flex flex-col items-center min-w-[180px] p-4">
                <div class="w-10 h-10 flex items-center justify-center border-2 border-purple-500 text-purple-400 rounded-full font-bold">
                    8
                </div>
                <p class="text-sm font-bold text-purple-500 mt-2">Refleksi</p>
                <p class="text-xs text-gray-500 text-center">Pemberian pemahaman mengenai PJBL</p>
                {{-- <div class="absolute bottom-0 left-0 w-full h-1 bg-purple-500"></div> --}}
            </div>
        </div>
    </div>
    
    <div class="w-full h-300 bg-white shadow-md rounded-none p-8 mt-2 relative">
        <!-- Judul dan Timer -->
        <div class="flex justify-between items-center">
            <!-- Judul -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $pjbl->nama_syntax }}: {{ $pjbl->mata_pelajaran->nama_mapel }}</h2>
    
            <!-- Countdown Timer -->
            <div id="countdown-timer" class="bg-gray-800 text-white px-4 py-2 rounded shadow">
                Sisa waktu: {{ floor($pjbl->waktu / 60) }}:{{ str_pad($pjbl->waktu % 60, 2, '0', STR_PAD_LEFT) }}
            </div>
        </div>
      
        <!-- Isi Studi Kasus -->
        <p class="text-gray-700 text-lg leading-relaxed max-w-4xl">
          {{ $pjbl->isi_syntax }}
        </p>

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
        
            @if ($pjbl->pengumpulan == 1)
                <!-- Textarea untuk jawaban teks -->
                <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-700">Jawaban:</label>
                <textarea name="jawaban" id="jawaban" rows="5"
                          class="w-full p-3 border rounded-lg focus:outline-none focus:ring"
                          placeholder="Tulis jawabanmu di sini..."></textarea>
        
            @elseif ($pjbl->pengumpulan == 2)
                <!-- Input file untuk upload -->
                <label for="file" class="block mb-2 text-sm font-medium text-gray-700">Upload File:</label>
                <input type="file" name="file" id="file"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
            @endif
        
            @if ($pjbl->pengumpulan === 1 || $pjbl->pengumpulan === 2)
                <button type="submit"
                        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold">
                    Kirim Jawaban
                </button>
            @endif
        </form>
        
      
        <!-- Tombol Next -->
        {{-- <div class="absolute bottom-8 right-8">
            <a href="/siswa/pjbl/1_2" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-md transition">
                Next →
            </a>
        </div> --}}
    </div>
    <script>
       window.onload = function() {
        let waktu = @json($pjbl->waktu);
        let countdownElement = document.getElementById('countdown-timer');

        if (!countdownElement) {
            console.error('Elemen countdown-timer tidak ditemukan');
            return;
        }

        let timer = setInterval(function () {
            let minutes = Math.floor(waktu / 60);
            let seconds = waktu % 60;

            countdownElement.textContent = `Sisa waktu: ${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (waktu <= 0) {
                clearInterval(timer);
                @if ($next_slug)
                    window.location.href = "/siswa/pjbl/{{ $next_slug }}";
                @else
                    window.location.href = "/siswa/pjbl/selesai"; // misalnya halaman akhir
                @endif
                // fetch('/siswa/pjbl/selesai', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     },
                //     body: JSON.stringify({
                //         pjbl_id: {{ $pjbl->id }},
                //         user_id: {{ auth()->id() }},
                //         status: 'selesai',
                //         waktu_habis: true
                //     })
                // })
                // .then(response => {
                //     // Redirect setelah sukses
                //     window.location.href = "/siswa/pjbl/1_2";
                // })
                // .catch(error => {
                //     console.error('Gagal menyimpan data:', error);
                //     // Tetap redirect meskipun gagal
                //     window.location.href = "/siswa/pjbl/1_2";
                // });
            }

            waktu--;
        }, 1000);
    };

    </script>
    
    

</x-layout-siswa>