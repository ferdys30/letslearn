<?php

namespace App\Http\Controllers;

use App\Models\kuis;
use App\Models\soal;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    //slugg
    public function index(mata_pelajaran $mapel)
    {
        // Ambil semua kuis yang berelasi dengan mapel tertentu
        $kuisList = Kuis::where('id_mapel', $mapel->id)->get();

        return view('siswa/kuis/index', compact('kuisList', 'mapel'));
    }

    public function show(mata_pelajaran $mapel, Kuis $kuis)
    {
        $soals = Soal::where('id_kuis', $kuis->id)->orderBy('urutan')->get();
        return view('siswa.kuis.show', compact('kuis', 'soals'));
    }


    public function submit(Request $request, $kuisId)
    {
        $userId = Auth::id();
        $jawabanUser = $request->input('jawaban', []);
        $soals = Soal::where('id_kuis', $kuisId)->get();
        $totalNilai = 0;

        foreach ($soals as $soal) {
            $jawabanBenar = strtolower(trim($soal->jawaban_benar));
            $jawabanSiswa = strtolower(trim($jawabanUser[$soal->id] ?? ''));

            if ($jawabanSiswa === $jawabanBenar) {
                $totalNilai += intval($soal->point);
            }
        }

        // Cegah duplikat nilai
        $existing = Penilaian::where('id_user', $userId)->where('id_kuis', $kuisId)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Kamu sudah menyelesaikan kuis ini.');
        }

        Penilaian::create([
            'id_user' => $userId,
            'id_kuis' => $kuisId,
            'id_indikator' => null, // Bisa diisi nanti
            'nilai' => $totalNilai,
        ]);

        return redirect()
            ->route('kelas.kuis', ['mapel' => $request->mapel_slug ?? ''])
            ->with('success', 'Jawaban berhasil dikumpulkan. Nilai: ' . $totalNilai);
    }



    
    public function kuis(mata_pelajaran $mapel)
    {
        $daftar_kuis = Kuis::all();
        return view('guru.kuis.index', [
            'tittle' => 'Kuis',
            'daftar_kuis' => $daftar_kuis,
            'mapel' => $mapel
        ]);
    }

    public function soal(mata_pelajaran $mapel, Kuis $kuis)
    {
        // Validasi bahwa kuis ini milik mapel yang benar
        if ($kuis->id_mapel !== $mapel->id) {
            abort(404);
        }

        return view('guru.kuis.soal', [
            'tittle' => 'Tambahkan Soal',
            'kuis' => $kuis,
            'mapel' => $mapel
        ]);
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'urutan_kuis' => 'required|string',
            'judul_kuis' => 'required|string',
            'deskripsi_materi' => 'required|string',
            'durasi' => 'required|integer',
            'id_mapel' => 'required'
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
