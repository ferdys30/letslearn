<x-navbar-siswa></x-navbar-siswa>
<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <body>
        <?php
        $soal = [
            ['id' => 1, 'pertanyaan' => 'Apa ibu kota Indonesia?', 'opsi' => ['Jakarta', 'Bandung']],
            ['id' => 4, 'pertanyaan' => '2 + 2 = ?', 'opsi' => ['3', '4']],
        ];
        $totalSoal = count($soal);
        ?>
        
        <h2>Selamat Datang di Kuis</h2>
        <p>Total Soal: <strong><?= count($soal) ?></strong></p>
        <p class="timer hidden" id="timer">Waktu: <span id="waktu">--:--</span></p>

        <button id="startBtn">Mulai Kuis</button>

        <form id="quizForm" class="hidden">
            <input type="text" name="nama" placeholder="Masukkan nama Anda" required><br><br>

            <div id="soal-container">
                <?php foreach ($soal as $index => $s): ?>
                    <div class="soal-item hidden" data-index="<?= $index ?>">
                        <p><strong><?= ($index + 1) ?>. <?= $s['pertanyaan'] ?></strong></p>
                        <?php foreach ($s['opsi'] as $opsi): ?>
                            <label>
                                <input type="radio" name="jawaban[<?= $s['id'] ?>]" value="<?= $opsi ?>"> <?= $opsi ?>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="navigation hidden">
                <button type="button" id="prevBtn">Sebelumnya</button>
                <button type="button" id="nextBtn">Berikutnya</button>
                <button type="submit" id="submitBtn" class="hidden">Kirim Jawaban</button>
            </div>
        </form>

        <script>
            const startBtn = document.getElementById('startBtn');
            const quizForm = document.getElementById('quizForm');
            const timerDiv = document.getElementById('timer');
            const waktuEl = document.getElementById('waktu');
            const soalItems = document.querySelectorAll('.soal-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            const navigation = document.querySelector('.navigation');

            let waktuSisa = 120; // dalam detik
            let timerInterval;
            let currentSoal = 0;

            function mulaiTimer() {
                timerInterval = setInterval(() => {
                    waktuSisa--;
                    const menit = Math.floor(waktuSisa / 60);
                    const detik = waktuSisa % 60;
                    waktuEl.innerText = `${menit.toString().padStart(2, '0')}:${detik.toString().padStart(2, '0')}`;
                    if (waktuSisa <= 0) {
                        clearInterval(timerInterval);
                        alert('Waktu habis! Jawaban akan dikirim otomatis.');
                        quizForm.submit();
                    }
                }, 1000);
            }

            function tampilkanSoal(index) {
                soalItems.forEach((item, i) => {
                    item.classList.add('hidden');
                    if (i === index) item.classList.remove('hidden');
                });

                prevBtn.disabled = index === 0;
                nextBtn.classList.toggle('hidden', index === soalItems.length - 1);
                submitBtn.classList.toggle('hidden', index !== soalItems.length - 1);
            }

            startBtn.addEventListener('click', () => {
                startBtn.classList.add('hidden');
                quizForm.classList.remove('hidden');
                timerDiv.classList.remove('hidden');
                navigation.classList.remove('hidden');
                tampilkanSoal(currentSoal);
                mulaiTimer();
            });

            nextBtn.addEventListener('click', () => {
                if (currentSoal < soalItems.length - 1) {
                    currentSoal++;
                    tampilkanSoal(currentSoal);
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentSoal > 0) {
                    currentSoal--;
                    tampilkanSoal(currentSoal);
                }
            });

            // Simpan jawaban ke localStorage (opsional)
            const radioInputs = document.querySelectorAll('input[type=radio]');
            radioInputs.forEach(input => {
                input.addEventListener('change', () => {
                    localStorage.setItem(input.name, input.value);
                });
                if (localStorage.getItem(input.name) === input.value) {
                    input.checked = true;
                }
            });
        </script>
    </body>
</x-layout-siswa>
