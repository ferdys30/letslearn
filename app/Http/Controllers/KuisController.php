<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kuis;
use App\Models\soal;

class KuisController extends Controller
{
    //slugg
   public function index()
    {
        $kuisList = Kuis::all(); // Bisa difilter per mapel nanti
        return view('siswa.kuis.index', compact('kuisList'));
    }

    public function show(Kuis $kuis)
    {
        $soals = Soal::where('id_kuis', $kuis->id)->orderBy('urutan')->get();
        return view('siswa.kuis.show', compact('kuis', 'soals'));
    }

    public function submit(Request $req, Kuis $kuis)
    {
        $jawaban = $req->except(['_token']);
        // Tambahkan logika simpan ke DB / penilaian di sini
        return redirect()->route('siswa.kuis.index')->with('success', 'Jawaban berhasil dikirim!');
    }


    
    public function kuis()
    {
        $daftar_kuis = Kuis::all();
        return view('guru.kuis.index', [
            'tittle' => 'Kuis',
            'daftar_kuis' => $daftar_kuis
        ]);
    }

    public function soal(Kuis $kuis)
    {
        $kuis->load('soals'); // eager load soals
        return view('guru.kuis.soal', [
            'tittle' => 'Tambahkan Soal',
            'kuis' => $kuis
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'urutan_kuis' => 'required|string',
            'judul_kuis' => 'required|string',
            'deskripsi_materi' => 'required|string',
            'durasi' => 'required|integer',
            'id_mapel' => 'required|exists:mata_pelajarans,id'
        ]);

        $kuis = new Kuis();
        $kuis->urutan_kuis = $validated['urutan_kuis'];
        $kuis->judul = $validated['judul_kuis'];
        $kuis->deskripsi_kuis = $validated['deskripsi_materi'];
        $kuis->waktu_pengerjaan = $validated['durasi'];
        $kuis->id_mapel = $validated['id_mapel'];
        $kuis->save();

        return redirect('/guru/kuis')->with('success', 'Kuis berhasil ditambahkan!');
    }

    public function store_soal(Request $request, Kuis $kuis)
    {
        $validated = $request->validate([
            'urutan_soal' => 'required|string',
            'pertanyaan' => 'required|string',
            'jawaban_a' => 'required|string',
            'jawaban_b' => 'required|string',
            'jawaban_c' => 'required|string',
            'jawaban_d' => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        $soal = new Soal();
        $soal->id_kuis = $kuis->id;
        $soal->urutan = $validated['urutan_soal'];
        $soal->pertanyaan = $validated['pertanyaan'];
        $soal->jawaban_a = $validated['jawaban_a'];
        $soal->jawaban_b = $validated['jawaban_b'];
        $soal->jawaban_c = $validated['jawaban_c'];
        $soal->jawaban_d = $validated['jawaban_d'];
        $soal->jawaban_benar = strtoupper($validated['jawaban_benar']);
        $soal->point = 10; // Atau bisa disesuaikan
        $soal->save();

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan!');
    }

    
}
