<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800">Kuis Pemrograman</h1>

    <div class="flex mt-6" x-data="{ session: 1, step: 1, timer: 300, totalQuestions: 20, answered: 0 }" x-init="startTimer()">
        <!-- Sidebar Navigasi Sesi -->
        <div class="w-1/4 space-y-2">
            <button @click="session = 1" :class="{ 'bg-purple-600 text-white': session === 1 }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Kuis 1
            </button>
            <button @click="session = 2" :class="{ 'bg-purple-600 text-white': session === 2 }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Kuis 2
            </button>
            <button @click="session = 3" :class="{ 'bg-purple-600 text-white': session === 3 }" class="block w-full text-left px-4 py-3 rounded-lg bg-gray-200 hover:bg-purple-700 hover:text-white transition duration-300 ease-in-out">
                Kuis 3
            </button>
        </div>

        <!-- Konten Kuis -->
        <div class="w-3/4 p-6 bg-gray-50 rounded-lg shadow-inner">
            <!-- Timer -->
            <div class="text-right text-xl font-semibold mb-4">
                <span x-text="'Waktu: ' + timer + ' detik'"></span>
            </div>

            <!-- Soal Sesi 1 -->
            <div x-show="session === 1">
                <div x-show="step <= totalQuestions" class="mb-4">
                    <p class="text-gray-600" x-text="'Soal ' + step + ': ' + 'Apa itu HTML?'"></p>
                    <div class="space-y-2">
                        <label><input type="radio" name="soal1" value="a"> A. HyperText Markup Language</label>
                        <label><input type="radio" name="soal1" value="b"> B. Home Tool Markup Language</label>
                        <label><input type="radio" name="soal1" value="c"> C. HyperTransfer Markup Language</label>
                        <label><input type="radio" name="soal1" value="d"> D. None of the above</label>
                    </div>
                    <button @click="step++; answered++; $nextTick(() => { if (step > totalQuestions) { alert('Sesi selesai!') } })" class="bg-purple-600 text-white px-4 py-2 mt-4 rounded-md hover:bg-purple-700 transition duration-300 ease-in-out">Selanjutnya</button>
                </div>

                <!-- Setelah soal terakhir -->
                <div x-show="step > totalQuestions" class="mt-6 text-center">
                    <button @click="alert('Sesi 1 selesai!')" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                        Submit Sesi 1
                    </button>
                </div>
            </div>

            <!-- Sesi 2 -->
            <div x-show="session === 2">
                <div x-show="step <= totalQuestions" class="mb-4">
                    <p class="text-gray-600" x-text="'Soal ' + step + ': ' + 'Apa elemen dasar dalam HTML?'"></p>
                    <div class="space-y-2">
                        <label><input type="radio" name="soal2" value="a"> A. <head>, <body></label>
                        <label><input type="radio" name="soal2" value="b"> B. <html>, <body></label>
                        <label><input type="radio" name="soal2" value="c"> C. <header>, <footer></label>
                        <label><input type="radio" name="soal2" value="d"> D. <html>, <head></label>
                    </div>
                    <button @click="step++; answered++; $nextTick(() => { if (step > totalQuestions) { alert('Sesi selesai!') } })" class="bg-purple-600 text-white px-4 py-2 mt-4 rounded-md hover:bg-purple-700 transition duration-300 ease-in-out">Selanjutnya</button>
                </div>

                <!-- Setelah soal terakhir -->
                <div x-show="step > totalQuestions" class="mt-6 text-center">
                    <button @click="alert('Sesi 2 selesai!')" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                        Submit Sesi 2
                    </button>
                </div>
            </div>

            <!-- Sesi 3 -->
            <div x-show="session === 3">
                <div x-show="step <= totalQuestions" class="mb-4">
                    <p class="text-gray-600" x-text="'Soal ' + step + ': ' + 'Apa itu JavaScript?'"></p>
                    <div class="space-y-2">
                        <label><input type="radio" name="soal3" value="a"> A. Bahasa pemrograman untuk web</label>
                        <label><input type="radio" name="soal3" value="b"> B. Sistem manajemen basis data</label>
                        <label><input type="radio" name="soal3" value="c"> C. Desain grafis untuk web</label>
                        <label><input type="radio" name="soal3" value="d"> D. Aplikasi pengolah kata</label>
                    </div>
                    <button @click="step++; answered++; $nextTick(() => { if (step > totalQuestions) { alert('Sesi selesai!') } })" class="bg-purple-600 text-white px-4 py-2 mt-4 rounded-md hover:bg-purple-700 transition duration-300 ease-in-out">Selanjutnya</button>
                </div>

                <!-- Setelah soal terakhir -->
                <div x-show="step > totalQuestions" class="mt-6 text-center">
                    <button @click="alert('Sesi 3 selesai!')" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                        Submit Sesi 3
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function startTimer() {
        let timerInterval = setInterval(() => {
            if (this.timer > 0) {
                this.timer--;
            } else {
                clearInterval(timerInterval);
                alert("Waktu habis!");
            }
        }, 1000);
    }
</script>
</x-layout-siswa>
