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
    <form id="form-pengumpulan_tugas" 
      action="{{ route('siswa.kelas.kuis.submit', $kuis) }}" 
      method="POST"
      x-ref="form">
    @csrf
      @foreach($soals as $index => $soal)
  <div class="mb-6 border-b pb-4">
      <p class="font-semibold text-gray-800 mb-2">Soal {{ $index+1 }}:</p>
      @if ($soal->gambar)
          <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal" class="mb-3 max-w-full rounded-lg shadow">
      @endif
      <pre class="bg-gray-100 p-2 rounded text-sm whitespace-pre-wrap">{{ $soal->pertanyaan }}</pre>

      <div class="space-y-2 text-gray-700 mt-2">
          @foreach(['a','b','c','d','e'] as $option)
              @php
                  $jawaban = $soal->{'jawaban_'.$option};
                  $isCode = str_contains($jawaban, '<') || str_contains($jawaban, '>');
              @endphp
              <label class="block">
                  <input type="radio" 
                         name="jawaban[{{ $soal->id }}]" 
                         value="{{ $option }}"> 
                  {{ strtoupper($option) }}. 
                  @if($isCode)
                      <pre class="bg-gray-100 p-2 rounded text-sm whitespace-pre-wrap">{{ $jawaban }}</pre>
                  @else
                      {{ $jawaban }}
                  @endif
              </label>
          @endforeach
      </div>
  </div>
@endforeach




      <!-- Submit Button -->
      <button type="button" 
            @click="submitAnswers()"
            class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
        Submit Semua Jawaban
    </button>
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
      const form = document.getElementById('form-pengumpulan_tugas');

      this.timerInterval = setInterval(() => {
        const m = Math.floor(this.timer / 60);
        const s = this.timer % 60;
        el.textContent = `${m}:${String(s).padStart(2, '0')}`;

        if (this.timer <= 0) {
          clearInterval(this.timerInterval);
          form.submit(); // auto-submit saat waktu habis
        }
        this.timer--;
      }, 1000);
    },
    submitAnswers() {
      clearInterval(this.timerInterval);
      this.$refs.form.submit(); // gunakan Alpine x-ref
    }
  }
}

  </script>
</x-layout-siswa>
