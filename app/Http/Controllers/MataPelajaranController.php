<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\indikator_penilaian;
use App\Models\studi_kasus;
use App\Models\anggota_kelompok;
use App\Models\pjbl;
use App\Models\Pengumpulan;
use App\Models\kelompok;
use App\Models\tujuan_pembelajaran;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index(mata_pelajaran $mapel)
    {
        $user = Auth::user();

        // Cek apakah mapel ini milik guru yang login
        if ($mapel->id_user !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil kelompok, studi kasus, anggota sesuai mapel
        $kelompok = Kelompok::where('id_mapel', $mapel->id)->get();
        $studiKasus = studi_kasus::where('id_mapel', $mapel->id)->get();
        $kelompokIds = $kelompok->pluck('id');
        $anggota = anggota_kelompok::whereIn('id_kelompok', $kelompokIds)->get();

        foreach ($kelompok as $klmpk) {
            $totalSyntax = pjbl::where('id_mapel', $mapel->id)->count();
            $pengumpulanCount = pengumpulan::where('id_kelompok', $klmpk->id)
                ->whereIn('id_pjbl', pjbl::where('id_mapel', $mapel->id)->pluck('id'))
                ->count();

            $klmpk->progress = $totalSyntax > 0
                ? round(($pengumpulanCount / $totalSyntax) * 100, 2)
                : 0;
        }

        $pengumpulanBelumDivalidasi = pengumpulan::where('status', '1')
            ->where('id_mapel', $mapel->id)
            ->count();

        if ($pengumpulanBelumDivalidasi > 0) {
            session()->flash('pengumpulan_alert', "Ada $pengumpulanBelumDivalidasi pengumpulan tugas yang menunggu validasi.");
        }

        return view('guru.mapel.index', [
            'tittle' => 'Mata Pelajaran',
            'mapelList' => [$mapel], // tetap array agar konsisten
            'kelompok' => $kelompok,
            'studi_kasus' => $studiKasus,
            'anggota' => $anggota,
            'mapel' => $mapel
        ]);
    }

    public function detail(mata_pelajaran $mapel){
         // Ambil tujuan pembelajaran sesuai id_kelas dari mapel pertama
        $tujuan_pembelajaran = tujuan_pembelajaran::where('id_mapel', $mapel->id)->get();
        $indikator_penilaian = indikator_penilaian::where('id_mapel', $mapel->id)->get();
        // dd($tujuan_pembelajaran);
        // dd($mapel);
        return view('guru/mapel/detail', [
            'tittle' => 'Kelompok',
            'mapel' => $mapel,
            'indikator_penilaian' => $indikator_penilaian,
            'tujuan_pembelajaran' => $tujuan_pembelajaran,
        ]);
    }

    public function store_tp(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'tujuan_pembelajaran' => 'required',
        ]);
        // dd($validatedData);
        tujuan_pembelajaran::create($validatedData);

        return redirect()->back();
    }

    public function store_indikator(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'indikator_penilaian' => 'required',
            'skema' => 'required',
            'skala_1' => 'required',
            'skala_2' => 'required',
            'skala_3' => 'required',
            'skala_4' => 'required',
            'skala_5' => 'required',
        ]);
        // dd($validatedData);
        indikator_penilaian::create($validatedData);

        return redirect()->back();
    }
}
