<?php

namespace App\Http\Controllers;

use App\Models\kuis;
use App\Models\soal;
use App\Models\Mapel;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KuisController extends Controller
{
    //slugg
    public function index(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        // Ambil semua kuis yang berelasi dengan mapel tertentu
        $kuisList = Kuis::where('id_mapel', $mapel->id)->get();

        return view('siswa/kuis/index', compact('kuisList', 'mapel'));
    }

    public function show(string $mapel_slug, Kuis $kuis)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $soals = Soal::where('id_kuis', $kuis->id)->orderBy('urutan')->get();
        return view('siswa.kuis.show', compact('kuis', 'soals'));
    }


    public function submit(Request $request, $kuisId)
    {
        // dd($request->all());
        $userId = Auth::id();
        $jawabanUser = collect($request->input('jawaban', []))->sortKeys();
        $soals = Soal::where('id_kuis', $kuisId)->get();
        $totalNilai = 0;
        $jawabanDetail = [];

        foreach ($soals as $soal) {
            $jawabanBenar = strtolower(trim($soal->jawaban_benar));
            $jawabanSiswa = strtolower(trim($jawabanUser[$soal->id] ?? ''));

            $isBenar = $jawabanSiswa === $jawabanBenar;
            if ($isBenar) {
                $totalNilai += intval($soal->point);
            }

            $jawabanDetail[] = [
                'pertanyaan' => $soal->pertanyaan,
                'jawaban_siswa' => strtoupper($jawabanSiswa),
                'jawaban_benar' => strtoupper($jawabanBenar),
                'benar' => $isBenar ? 'benar' : 'salah',
                'point' => $soal->point,
            ];
        }

        $existing = Penilaian::where('id_user', $userId)->where('id_kuis', $kuisId)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Kamu sudah menyelesaikan kuis ini.');
        }

        // ✅ Generate PDF
        $pdf = PDF::loadView('pdf.jawaban', [
            'jawabanDetail' => $jawabanDetail,
            'totalNilai' => $totalNilai,
            'namaUser' => Auth::user()->nama,
            'judulKuis' => $kuisId,
        ]);

        $filename = 'jawaban_kuis_' . $kuisId . '_user_' . $userId . '.pdf';
        $path = storage_path('app/public/jawaban/' . $filename);
        $pdf->save($path);

        Penilaian::create([
            'id_user' => $userId,
            'id_kuis' => $kuisId,
            'id_indikator' => null,
            'nilai' => $totalNilai,
            'file_jawaban' => 'jawaban/' . $filename,
        ]);

        return redirect()
            ->route('siswa.kelas.kuis', ['mapel' => $request->mapel_slug ?? ''])
            ->with('success', 'Jawaban berhasil dikumpulkan. Nilai: ' . $totalNilai);
    }
    
    public function kuis(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        // $mapel = Mapel::where('slug', $slug)->firstOrFail(); // otomatis 404 jika slug salah
        $daftar_kuis = Kuis::all();
        return view('guru.kuis.index', [
            'tittle' => 'Kuis',
            'daftar_kuis' => $daftar_kuis,
            'mapel' => $mapel
        ]);
    }

    public function soal(string $mapel_slug, Kuis $kuis)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
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




    public function store_kuis(Request $request)
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

        return redirect()->back()->with('success', 'Kuis berhasil ditambahkan!');
    }
    public function update_kuis(Request $request, $id)
    {
        $request->validate([
        'urutan_kuis' => 'required',
        'judul' => 'required|string',
        'deskripsi_kuis' => 'nullable|string',
        'waktu_pengerjaan' => 'required|string',
        ]);

        $kuis = Kuis::findOrFail($id);
        $kuis->update([
            'urutan_kuis' => $request->urutan_kuis,
            'judul' => $request->judul,
            'deskripsi_kuis' => $request->deskripsi_kuis,
            'waktu_pengerjaan' => $request->waktu_pengerjaan,
        ]);

        return redirect()->back()->with('success', 'Kuis berhasil diperbarui.');
    }

    public function store_soal(Request $request)
    {
        $kuis = Kuis::findOrFail($request->id_kuis);

        $validated = $request->validate([
            'urutan_soal'   => 'required|integer',
            'pertanyaan'    => 'required|string',
            'jawaban_a'     => 'required|string',
            'jawaban_b'     => 'required|string',
            'jawaban_c'     => 'required|string',
            'jawaban_d'     => 'required|string',
            'jawaban_e'     => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d,e',
            'point'         => 'required|numeric|min:1',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('soal', 'public')
            : null;

        Soal::create([
            'id_kuis'       => $kuis->id,
            'urutan'        => $validated['urutan_soal'],
            'pertanyaan'    => $validated['pertanyaan'],
            'jawaban_a'     => $validated['jawaban_a'],
            'jawaban_b'     => $validated['jawaban_b'],
            'jawaban_c'     => $validated['jawaban_c'],
            'jawaban_d'     => $validated['jawaban_d'],
            'jawaban_e'     => $validated['jawaban_e'],
            'jawaban_benar' => strtolower($validated['jawaban_benar']),
            'point'         => $validated['point'],
            'gambar'        => $path,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan!');
    }


    public function update_soal(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $validated = $request->validate([
            'urutan_soal'   => 'required|integer',
            'pertanyaan'    => 'required|string',
            'jawaban_a'     => 'required|string',
            'jawaban_b'     => 'required|string',
            'jawaban_c'     => 'required|string',
            'jawaban_d'     => 'required|string',
            'jawaban_e'     => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'point'         => 'required|numeric|min:1',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            if ($soal->gambar && Storage::disk('public')->exists($soal->gambar)) {
                Storage::disk('public')->delete($soal->gambar);
            }
            $soal->gambar = $request->file('gambar')->store('soal', 'public');
        }

        $soal->update([
            'urutan'        => $validated['urutan_soal'],
            'pertanyaan'    => $validated['pertanyaan'],
            'jawaban_a'     => $validated['jawaban_a'],
            'jawaban_b'     => $validated['jawaban_b'],
            'jawaban_c'     => $validated['jawaban_c'],
            'jawaban_d'     => $validated['jawaban_d'],
            'jawaban_e'     => $validated['jawaban_e'],
            'jawaban_benar' => strtolower($validated['jawaban_benar']),
            'point'         => $validated['point'],
            'gambar'        => $soal->gambar, // tetap pakai lama kalau tidak upload baru
        ]);

        return redirect()->back()->with('success', 'Soal berhasil diperbarui.');
    }

    public function delete_soal($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }

    
}
