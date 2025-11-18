<x-navbar-siswa></x-navbar-siswa>

<style>
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

    <div class="w-full h-300 bg-white shadow-md rounded-none p-8 mt-2 relative">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                {{ $aktivitas_pjbl->nama_syntax }}: {{ $aktivitas_pjbl->Mapel->nama_mapel }}
            </h2>

            @if ($aktivitas_pjbl->pengumpulan_tugas === 1 || $aktivitas_pjbl->pengumpulan_tugas === 2||$aktivitas_pjbl->pengumpulan_tugas === NULL)
                <div id="countdown-timer" class="bg-gray-800 text-white px-4 py-2 rounded shadow">
                    Sisa waktu: {{ floor($aktivitas_pjbl->waktu / 60) }}:{{ str_pad($aktivitas_pjbl->waktu % 60, 2, '0', STR_PAD_LEFT) }}
                </div>
            @endif
        </div>

        @foreach ($studi_kasus as $kasus)
            <p class="text-gray-700 text-lg leading-relaxed max-w-4xl">
                {{ $kasus->studi_kasus }}
            </p>
        @endforeach

        @if ($aktivitas_pjbl->pengumpulan_tugas !== 3)
            <form id="form-pengumpulan_tugas" action="{{ route('siswa.kelas.aktivitas_pjbl.pengumpulan_tugas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_kelompok_pjbl" value="{{ $kelompok_pjblUser->id_kelompok_pjbl }}">
                <input type="hidden" name="id_aktivitas_pjbl" value="{{ $aktivitas_pjbl->id }}">
                <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus_pjbl->id }}">
                <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                @if ($aktivitas_pjbl->pengumpulan_tugas == 1)
                    <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-700">Jawaban:</label>
                    <textarea name="deskriptif" id="jawaban" rows="5"
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring"
                        placeholder="Tulis jawabanmu di sini..."></textarea>
                @elseif ($aktivitas_pjbl->pengumpulan_tugas == 2)
                    <label for="file" class="block mb-2 text-sm font-medium text-gray-700">Upload File:</label>
                    <input type="file" name="file_pengumpulan_tugas" id="file"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                @endif

                <button type="submit" class="hidden">Submit</button>
            </form>
        @endif
    </div>

    @if ($aktivitas_pjbl->pengumpulan_tugas == 3)
        <section class="container mx-auto px lg:px-10 py-12 bg-white rounded-md">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-bold text-gray-800">Rencana dan progress proyek</h2>

                @if ($canCreateTugas)
                    <div class="flex space-x-2">
                        <!-- Button Tambah siklus_pjbl -->
                        <button type="button"
                            onclick="toggleModal(true)"
                            class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition duration-200">
                            + Tambah Siklus PJBL
                        </button>
                    </div>
                @endif
            </div>

            @if ($tugas->count() > 0)
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($tugas as $t)
                        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col text-left">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $t->judul }}</h3>
                            <p class="text-gray-600 mt-2">{{ $t->deskripsi }}</p>
                            <div class="mt-4 text-sm text-gray-500">
                                <p>Deadline:
                                    <span class="font-semibold text-purple-600">
                                        {{ Carbon\Carbon::parse($t->deadline)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mt-8">Belum Penugasan yang ditambahkan.</p>
            @endif

            {{-- Form Tandai Selesai di kanan bawah --}}
            @if ($canCreateTugas)
                <div class="mt-8 flex justify-end">
                    <form action="{{ route('siswa.kelas.aktivitas_pjbl.pengumpulan_tugas') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kelompok_pjbl" value="{{ $kelompok_pjblUser->id_kelompok_pjbl }}">
                        <input type="hidden" name="id_aktivitas_pjbl" value="{{ $aktivitas_pjbl->id }}">
                        <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus_pjbl->id }}">
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                            Tandai Selesai
                        </button>
                    </form>
                </div>
            @endif
        </section>


        <!-- Modal -->
        <div id="modalTugas" class="hidden fixed inset-0 bg-black bg-opacity-30 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
                <h2 class="text-2xl font-bold mb-4">Tambah Tugas</h2>
                <form method="POST" action="{{ route('siswa.tugas.store') }}">
                    @csrf
                    <input type="hidden" name="id_aktivitas_pjbl" value="{{ $aktivitas_pjbl->id }}">
                    <input type="hidden" name="id_siklus_pjbl" value="{{ $siklus_pjbl->id }}">

                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">Diberikan kepada</label>
                        <select name="id_anggota_kelompok" class="w-full border p-2 rounded" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($anggotakelompok_pjbl as $anggota)
                                <option value="{{ $anggota->id }}">
                                    {{ $anggota->user->name }} - {{ $anggota->posisi->nama_posisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="w-full border p-2 rounded" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Simpan</button>
                        <button type="button" onclick="toggleModal(false)" class="ml-2 px-4 py-2 border rounded">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modalTugas');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>

    @if ($aktivitas_pjbl->pengumpulan_tugas === 1 || $aktivitas_pjbl->pengumpulan_tugas === 2||$aktivitas_pjbl->pengumpulan_tugas === NULL)
        <script>
            window.onload = function () {
                let waktu = @json($aktivitas_pjbl->waktu);
                let countdownElement = document.getElementById('countdown-timer');
                let form = document.getElementById('form-pengumpulan_tugas');

                if (!countdownElement || !form) return;

                let timer = setInterval(function () {
                    let minutes = Math.floor(waktu / 60);
                    let seconds = waktu % 60;

                    countdownElement.textContent = `Sisa waktu: ${minutes}:${seconds.toString().padStart(2, '0')}`;

                    if (waktu <= 0) {
                        clearInterval(timer);
                        console.log('Waktu habis, menyubmit form...');
                        form.submit();
                    }

                    waktu--;
                }, 1000);
            };
        </script>
    @endif
</x-layout-siswa>
