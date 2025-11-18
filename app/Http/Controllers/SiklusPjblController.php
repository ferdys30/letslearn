<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Posisi;
use App\Models\Pertemuan;
use App\Models\siklus_pjbl;
use App\Models\studi_kasus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\kelompok_pjbl;
use App\Models\aktivitas_pjbl;
use App\Models\pengumpulan_tugas;
use App\Models\indikator_penilaian;
use App\Http\Controllers\Controller;

class SiklusPjblController extends Controller
{
    public function index($mapel_slug, $siklus_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus = $mapel->siklusPjbls()->where('slug', $siklus_slug)->firstOrFail();

        // Ambil semua aktivitas/syntax untuk mapel ini
        $aktivitas = aktivitas_pjbl::where('id_mapel', $mapel->id)->get();
        $aktivitasIds = $aktivitas->pluck('id');
        $totalSyntax = $aktivitas->count();

        $kelompoks = $siklus->kelompok_pjbls()
            ->with(['studi_kasus', 'anggota_kelompok'])
            ->get();

        foreach ($kelompoks as $kelompok) {

            // Ambil semua pengumpulan tugas kelompok ini
            $tugas = pengumpulan_tugas::where('id_kelompok_pjbl', $kelompok->id)
                ->whereIn('id_aktivitas_pjbl', $aktivitasIds)
                ->get()
                ->keyBy('id_aktivitas_pjbl'); // supaya mudah dicari per kolom

            // Simpan status per syntax
            $statusPerSyntax = [];
            foreach ($aktivitas as $act) {
                $statusPerSyntax[$act->id] = $tugas[$act->id]->status ?? null;
            }

            // Hitung progress
            $selesai = collect($statusPerSyntax)->filter(fn($v) => $v == 2)->count();
            $kelompok->progress = $totalSyntax > 0
                ? round(($selesai / $totalSyntax) * 100, 2)
                : 0;

            $kelompok->status_syntax = $statusPerSyntax;
            $kelompok->jumlah_anggota = $kelompok->anggota_kelompoks->count();
        }

        return view('guru.pjbl.index', [
            'title' => 'Siklus',
            'mapel' => $mapel,
            'siklus' => $siklus,
            'kelompoks' => $kelompoks,
            'aktivitas' => $aktivitas // kirim ke view
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mapel' => 'required|exists:mapels,id',
            'nama_siklus_pjbl' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['nama_siklus_pjbl']);

        // dd($validated);
        siklus_pjbl::create($validated);

        return redirect()->back()->with('success', 'Siklus PJBL berhasil ditambahkan.');
    }

    public function indikator($mapel_slug, $siklus_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus = siklus_pjbl::where('slug', $siklus_slug)
            ->where('id_mapel', $mapel->id)
            ->firstOrFail();
        // $posisi = Posisi::where('id_siklus_pjbl', $siklus->id)->get();


        // Ambil indikator berdasarkan siklus
        $indikators = indikator_penilaian::where('id_siklus_pjbl', $siklus->id)->get();

        // dd($indikators);
        return view('guru.pjbl.indikator', [
            'title' => 'Indikator',
            'mapel' => $mapel,
            // 'posisi' => $posisi,
            'siklus' => $siklus,
            'indikator_penilaian' => $indikators,
        ]);
    }

    public function studi_kasus($mapel_slug, $siklus_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();

        $siklus = siklus_pjbl::where('slug', $siklus_slug)
            ->where('id_mapel', $mapel->id)
            ->firstOrFail();

        // Ambil semua kelompok berdasarkan siklus
        $kelompok_pjbl = kelompok_pjbl::where('id_siklus_pjbl', $siklus->id)->get();

        // Ambil studi_kasus yang terkait dengan siklus ini
        $studi_kasus = studi_kasus::whereHas('kelompok_pjbl', function ($query) use ($siklus) {
            $query->where('id_siklus_pjbl', $siklus->id);
        })->get();

        return view('guru.pjbl.studi_kasus', [
            'title' => 'studi_kasus',
            'mapel' => $mapel,
            'siklus' => $siklus,
            'kelompok_pjbl' => $kelompok_pjbl,
            'studi_kasus' => $studi_kasus,
        ]);
    }


    public function aktivitas_pjbl($mapel_slug, $siklus_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus = siklus_pjbl::where('slug', $siklus_slug)
            ->where('id_mapel', $mapel->id)
            ->firstOrFail();

        $syntax = aktivitas_pjbl::where('id_mapel', $mapel->id)
            ->where('id_siklus_pjbl', $siklus->id)
            ->orderBy('urutan', 'asc')
            ->get();

        $pertemuan = Pertemuan::where('id_mapel', $mapel->id)->get(); // ⬅️ ambil semua pertemuan berdasarkan mapel

        // dd($siklus);
        return view('guru.pjbl.aktivitas_pjbl', [
            'title' => 'aktivitas pjbl',
            'mapel' => $mapel,
            'siklus' => $siklus,
            'syntax' => $syntax,
            'pertemuan' => $pertemuan, // ⬅️ kirim ke blade
        ]);
    }
}
