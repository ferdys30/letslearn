<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mapel;
use App\Models\siklus_pjbl;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapController extends Controller
{
    public function index($slug)
{
    $mapel = Mapel::where('slug', $slug)->firstOrFail();

    // ambil siswa sesuai kelas
    $dataSekarang = User::where('id_kelas', $mapel->id_kelas)
        ->where('id_role', 3)
        ->with(['penilaians' => function($q) use ($mapel) {
            $q->where(function($q2) use ($mapel) {
                // ambil penilaian dari indikator yang terkait mapel
                $q2->whereHas('indikator', function($sub) use ($mapel) {
                    $sub->where('id_mapel', $mapel->id);
                })
                // ambil juga penilaian dari kuis atau siklus mapel ini
                ->orWhereHas('kuis', function($sub) use ($mapel) {
                    $sub->where('id_mapel', $mapel->id);
                })
                ->orWhereHas('indikator.siklusPjbl', function($sub) use ($mapel) {
    $sub->where('id_mapel', $mapel->id);
});

            });
        }])
        ->get();

    // siswa di luar kelas (history)
    $dataHistory = User::where('id_kelas', '!=', $mapel->id_kelas)
        ->where('id_role', 3)
        ->with(['penilaians' => function($q) use ($mapel) {
            $q->where(function($q2) use ($mapel) {
                $q2->whereHas('indikator', function($sub) use ($mapel) {
                    $sub->where('id_mapel', $mapel->id);
                })
                ->orWhereHas('kuis', function($sub) use ($mapel) {
                    $sub->where('id_mapel', $mapel->id);
                })
                ->orWhereHas('indikator.siklusPjbl', function($sub) use ($mapel) {
    $sub->where('id_mapel', $mapel->id);
});

            });
        }])
        ->get();

    // ambil list kuis dan siklus biar kolom muncul walau belum ada nilai
    $kuisList = $mapel->kuis ?? collect();
    $siklusList = $mapel->siklusPjbls ?? collect();
    // dd($siklusList);

    return view('guru.rekap.index', compact('mapel', 'kuisList', 'siklusList', 'dataSekarang', 'dataHistory'));
// dd($kuisList->toArray(), $siklusList->toArray());

}

public function detailSiklus($slug, $idSiswa, $idSiklus)
    {
        // Ambil data mapel dari slug
        $mapel = Mapel::where('slug', $slug)->firstOrFail();

        // Ambil siswa
        $siswa = User::with('kelas')->findOrFail($idSiswa);

        // Ambil siklus
        $siklus = Siklus_pjbl::findOrFail($idSiklus);

        // Ambil semua penilaian siswa ini pada siklus tersebut
        $penilaians = Penilaian::with(['indikator.aktivitas_pjbl'])
            ->where('id_user', $idSiswa)
            ->whereHas('indikator', function ($q) use ($idSiklus) {
                $q->where('id_siklus_pjbl', $idSiklus);
            })
            ->get();

        // Hitung total & rata-rata
        $totalNilai = $penilaians->sum('nilai');
        $rataRata = $penilaians->count() > 0 ? round($totalNilai / $penilaians->count(), 2) : 0;

        return view('guru.rekap.detail-siklus', compact(
            'mapel',
            'siswa',
            'siklus',
            'penilaians',
            'totalNilai',
            'rataRata'
        ));
    }

}

