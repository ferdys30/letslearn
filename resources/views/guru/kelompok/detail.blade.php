<x-navbar-guru></x-navbar-guru>
<x-layout-guru>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 py-6">
        @foreach ($anggotakelompok_pjbl as $anggota)
            <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-4">
                {{-- <img src="https://i.pravatar.cc/60?img={{ $loop->iteration }}" alt="Foto Siswa" class="w-14 h-14 rounded-md object-cover"> --}}
                <div>
                    <h3 class="text-md font-semibold text-gray-800">{{ $anggota->user->nama }}</h3>
                    <p class="text-sm text-gray-500">{{ $anggota->posisi->nama_posisi ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </section>

    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg" x-data="{ tab: null, openModal: false, selectedJawaban: null }">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('guru.Project_Based_Learning') }} {{ __('guru.Mata_Pelajaran') }}
            <span class="text-purple-600">{{ $mapel->nama_mapel }}</span>
        </h1>

        <div class="flex mt-6">
            <!-- Sidebar Navigasi -->
            <div class="w-1/4 space-y-2">
                @foreach ($aktivitas_pjbls as $aktivitas_pjbl)
                    <button @click="tab = '{{ $aktivitas_pjbl->slug }}'"
                        :class="{ 'bg-purple-600 text-white': tab === '{{ $aktivitas_pjbl->slug }}' }"
                        class="block w-full text-left px-4 py-3 rounded-lg 
                        {{ $aktivitas_pjbl->terkunci ? 'bg-gray-300 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-purple-700 hover:text-white transition' }}"
                        {{ $aktivitas_pjbl->terkunci ? 'disabled' : '' }}>
                        {{ $aktivitas_pjbl->nama_syntax }}
                    </button>
                @endforeach
            </div>

            <!-- Konten Aktivitas -->
            <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
                @foreach ($aktivitas_pjbls as $aktivitas_pjbl)
                    <div x-show="tab === '{{ $aktivitas_pjbl->slug }}'">
                        @if ($aktivitas_pjbl->terkunci)
                            <p class="text-red-500 font-semibold">
                                Konten ini belum bisa diakses. Menunggu validasi guru atau belum waktunya dibuka.
                            </p>
                        @else
                            <h2 class="text-xl font-semibold text-gray-700">{{ $aktivitas_pjbl->nama_syntax }}</h2>
                            <p class="mt-2 text-gray-600">{{ $aktivitas_pjbl->penjelasan }}</p>
                            @php
                                $jawaban = $pengumpulan_tugass[$aktivitas_pjbl->id] ?? null;
                            @endphp

                            @if ($aktivitas_pjbl->pengumpulan_tugas == 1 && $jawaban)
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold text-gray-700">{{ __('guru.Jawaban_Deskriptif') }}:</h4>
                                    @if (!empty($jawaban->deskriptif))
                                        @php
                                            // Pisahkan teks berdasarkan baris baru
                                            $items = preg_split('/\r\n|\r|\n/', trim($jawaban->deskriptif));
                                        @endphp
                                        <ol class="list-decimal list-inside text-gray-600 mt-1">
                                            @foreach ($items as $item)
                                                @if (!empty(trim($item)))
                                                    <li>{{ $item }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    @else
                                        <p class="text-gray-600 mt-1">{{ __('.guruBelum ada jawaban.') }}</p>
                                    @endif
                                </div>
                            @elseif ($aktivitas_pjbl->pengumpulan_tugas == 2 && $jawaban)
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold text-gray-700">{{ __('guru.File_Jawaban') }}:</h4>
                                    @if ($jawaban->file_pengumpulan_tugas)
                                        <a href="{{ asset('storage/' . $jawaban->file_pengumpulan_tugas) }}"
                                            class="text-blue-600 underline" target="_blank">
                                            {{ __('guru.Lihat_File') }}
                                        </a>
                                    @else
                                        <p class="text-gray-500">{{ __('guru.Belum_Ada_File') }}</p>
                                    @endif
                                </div>
                            @elseif (in_array($aktivitas_pjbl->pengumpulan_tugas, [3, 4, 5]))
                                @php
                                    // Ambil data tugas berdasarkan aktivitas
                                    $tugasAktivitas = $tugas_by_aktivitas[$aktivitas_pjbl->id] ?? collect();
                                @endphp

                                {{-- === JENIS 3 → LIST SIMPLE TANPA DEADLINE === --}}
                                @if ($aktivitas_pjbl->pengumpulan_tugas == 3)
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                                        @forelse ($tugasAktivitas as $t)
                                            <div class="bg-white shadow rounded-lg p-4">
                                                <h3 class="font-semibold text-gray-800">{{ $t->judul }}</h3>
                                                <p class="text-gray-600 mt-1">{{ $t->deskripsi }}</p>

                                                <p class="text-sm text-gray-500 mt-2">
                                                    {{ __('guru.Oleh') }}: <span
                                                        class="font-medium">{{ $t->anggotaKelompok->user->nama ?? '-' }}</span>
                                                </p>
                                            </div>
                                        @empty
                                            <p class="text-gray-500">{{ __('guru.Belum_Ada_Tugas') }}</p>
                                        @endforelse
                                    </div>
                                @endif

                                {{-- === JENIS 4 → LIST DENGAN DEADLINE === --}}
                                @if ($aktivitas_pjbl->pengumpulan_tugas == 4)
                                    @php $tugasAktivitas = $tugasAktivitas->sortBy('deadline'); @endphp

                                    <div class="mt-4 flex flex-col gap-4">
                                        @forelse ($tugasAktivitas as $t)
                                            <div class="bg-white shadow rounded-lg p-4 border">
                                                <h3 class="font-semibold text-gray-800">{{ $t->judul }}</h3>
                                                <p class="text-gray-600 mt-1">{{ $t->deskripsi }}</p>

                                                <div class="text-sm text-gray-500 mt-2">
                                                    <p>{{ __('guru.Deadline') }}:
                                                        <span class="text-purple-600 font-semibold">
                                                            {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y') }}
                                                        </span>
                                                    </p>
                                                    <p>{{ __('guru.Oleh') }}: {{ $t->anggotaKelompok->user->nama ?? '-' }}</p>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-gray-500">{{ __('guru.Belum_Ada_Tugas') }}</p>
                                        @endforelse
                                    </div>
                                @endif

                                {{-- === JENIS 5 → TAMPILAN TRELLO === --}}
                                @if ($aktivitas_pjbl->pengumpulan_tugas == 5)
                                    @php
                                        $tugasAktivitas = $tugasAktivitas->sortBy('deadline');
                                        $toDo = $tugasAktivitas->where('status', 0);
                                        $inProgress = $tugasAktivitas->filter(
                                            fn($t) => $t->status > 0 && $t->status < 100,
                                        );
                                        $done = $tugasAktivitas->where('status', 100);
                                    @endphp

                                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                                        {{-- TO DO --}}
                                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                            <h2 class="font-bold text-gray-700 mb-2">🟦 {{ __('guru.To_Do') }}</h2>
                                            @foreach ($toDo as $t)
                                                @include('components.card-tugas', ['tugas' => $t])
                                            @endforeach
                                        </div>

                                        {{-- IN PROGRESS --}}
                                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                            <h2 class="font-bold text-gray-700 mb-2">🟨 {{ __('guru.In_Progress') }}</h2>
                                            @foreach ($inProgress as $t)
                                                @include('components.card-progress', ['tugas' => $t])
                                            @endforeach
                                        </div>

                                        {{-- DONE --}}
                                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                            <h2 class="font-bold text-gray-700 mb-2">🟩 {{ __('guru.Done') }}</h2>
                                            @foreach ($done as $t)
                                                @include('components.card-done', ['tugas' => $t])
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @elseif($aktivitas_pjbl->pengumpulan_tugas == null)
                                {{-- <p class="text-gray-400 italic mt-2">Belum Dikumpulkan</p> --}}
                            @endif

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    {{ __('guru.Dibuka_Pada') }}:
                                    {{ \Carbon\Carbon::parse($aktivitas_pjbl->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                                </span>
                            </div>

                            @if ($jawaban)
                                <div class="mt-4 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between items-center">
                                        {{-- Status --}}
                                        <div class="flex items-center space-x-2">
                                            @if ($jawaban->status == '2')
                                                <span
                                                    class="flex items-center text-green-600 font-semibold bg-green-100 px-3 py-1 rounded-full text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    {{ __('guru.Sudah_Divalidasi') }}
                                                </span>
                                            @elseif ($jawaban->status == '1')
                                                <span
                                                    class="flex items-center text-yellow-600 font-semibold bg-yellow-100 px-3 py-1 rounded-full text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 8v4l3 3" />
                                                    </svg>
                                                    {{ __('guru.Menunggu_Validasi') }}
                                                </span>
                                            @else
                                                <span
                                                    class="flex items-center text-gray-600 font-semibold bg-gray-100 px-3 py-1 rounded-full text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 8v4m0 4h.01" />
                                                    </svg>
                                                    {{ __('guru.Belum_Dikumpulkan') }}
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Tombol Validasi --}}
                                        @if ($jawaban->status != '2')
                                            <button @click="openModal = true; selectedJawaban = {{ $jawaban->id }}"
                                                class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>{{ __('guru.Validasi_Nilai') }}</span>
                                            </button>
                                        @endif
                                    </div>

                                    {{-- Nilai --}}
                                    @if ($jawaban->status == '2' && $jawaban->nilai)
                                        <div class="mt-3 bg-green-50 border border-green-200 rounded-lg p-3">
                                            <p class="text-gray-800 text-sm">
                                                <span class="font-semibold text-green-700">{{ __('guru.Nilai') }}:</span>
                                                <span
                                                    class="text-lg font-bold text-green-800">{{ $jawaban->nilai }}</span>
                                            </p>
                                        </div>
                                    @endif
                                    {{-- ================= DISKUSI ================= --}}
                                    <div class="mt-6">
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ __('guru.Komentar') }}</h3>

                                        @php
                                            $diskusiAktivitas = $diskusi[$aktivitas_pjbl->id] ?? collect();
                                        @endphp

                                        <div class="space-y-3">
                                            @forelse ($diskusiAktivitas as $d)
                                                <div class="bg-white p-3 border rounded-lg shadow-sm">
                                                    <p class="text-sm text-gray-800">
                                                        <span class="font-semibold text-purple-700">
                                                            {{ $d->user->nama ?? 'User' }}:
                                                        </span>
                                                        {{ $d->pesan_diskusi }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y, H:i') }}
                                                    </p>
                                                </div>
                                            @empty
                                                <p class="text-gray-500 italic">{{ __('guru.Belum_Ada_Komentar') }}</p>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>
                            @endif

                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ✅ Modal Penilaian (Sekarang dalam satu x-data) -->
        <div x-show="openModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>

            <div @click.away="openModal = false" class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">

                <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('guru.Validasi_Tugas') }}</h2>

                <!-- 🔥 FORM VALIDASI (TANPA NILAI INPUT) -->
                <form :action="`/guru/aktivitas_pjbl/validasi/${selectedJawaban}`" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- <!-- Komentar Opsional -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catatan Penilaian (Opsional)</label>
                        <textarea name="catatan" rows="3"
                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Masukkan catatan penilaian..."></textarea>
                    </div> --}}

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="openModal = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            {{ __('guru.Tutup') }}
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            {{ __('guru.Validasi') }}
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- 🔥 FORM REVISI (WAJIB isi komentar) -->
                <form :action="`/guru/aktivitas_pjbl/revisi/${selectedJawaban}`" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-red-700">{{ __('guru.Komentar_Revisi_Wajib') }}</label>
                        <textarea name="komentar_revisi" required rows="3"
                            class="mt-1 w-full border border-red-400 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Jelaskan apa yang harus diperbaiki..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            {{ __('guru.Kirim_Revisi') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-guru>
