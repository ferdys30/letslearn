<x-navbar-siswa/>
<x-layout-siswa>
  <x-slot:tittle>{{ $kuis->judul }}</x-slot:tittle>
  
  <div x-data="quizApp({{ $kuis->waktu_pengerjaan * 60 }})"
       x-init="startTimer()"
       class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
       
    <!-- Timer -->
    <div class="text-center text-xl font-semibold mb-4">
      Waktu Tersisa <span id="countdown-timer" style="border: 2px solid #4F46E5; padding: 4px 8px; border-radius: 6px;"></span>
    </div>

    <!-- Soal Sekaligus -->
    <form id="form-pengumpulan" action="{{ route('siswa.kelas.kuis.submit', $kuis) }}" method="POST" @submit.prevent="submitAnswers()">
      @csrf
      @foreach($soals as $index => $soal)
      <div class="mb-6 border-b pb-4">
        <p class="font-semibold text-gray-800 mb-2">Soal {{ $index+1 }}: {{ $soal->pertanyaan }}</p>
        <div class="space-y-2 text-gray-700">
          <label>
            <input type="radio" name="jawaban[{{ $soal->id }}]" value="a"> A. {{ $soal->jawaban_a }}
          </label><br>
          <label>
            <input type="radio" name="jawaban[{{ $soal->id }}]" value="b"> B. {{ $soal->jawaban_b }}
          </label><br>
          <label>
            <input type="radio" name="jawaban[{{ $soal->id }}]" value="c"> C. {{ $soal->jawaban_c }}
          </label><br>
          <label>
            <input type="radio" name="jawaban[{{ $soal->id }}]" value="d"> D. {{ $soal->jawaban_d }}
          </label>
        </div>
      </div>
      @endforeach

      <!-- Submit Button -->
      <div class="text-right mt-8">
        <button type="submit"
                class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
          Submit Semua Jawaban
        </button>
      </div>
    </form>
  </div>

  <!-- Script Alpine.js + Timer -->
  <script>
    function quizApp(seconds) {
      return {
        timer: seconds,
        timerInterval: null,

        startTimer() {
          const el = document.getElementById('countdown-timer');
          const form = document.getElementById('form-pengumpulan');

          this.timerInterval = setInterval(() => {
            const m = Math.floor(this.timer/60);
            const s = this.timer % 60;
            el.textContent = `${m}:${String(s).padStart(2,'0')} `;

            if (this.timer <= 0) {
              clearInterval(this.timerInterval);
              form.submit();
            }
            this.timer--;
          }, 1000);
        },

        submitAnswers() {
          clearInterval(this.timerInterval);
          document.getElementById('form-pengumpulan').submit();
        }
      }
    }
  </script>
</x-layout-siswa>
