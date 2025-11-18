<?php

namespace App\Http\Controllers;

use App\Models\anggota_kelompok;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Penilaian;
use App\Models\siklus_pjbl;
use Illuminate\Http\Request;
use App\Models\kelompok_pjbl;
use Illuminate\Support\Facades\DB;
use App\Models\indikator_penilaian;

class PenilaianController extends Controller
{

    public function index($mapel_slug, $siklus_slug, $kelompok_id)
    {
        // 1. Coba ambil Mapel
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->first();

        // 2. Coba ambil Siklus
        $siklus_pjbl = \App\Models\siklus_pjbl::where('slug', $siklus_slug)->first();

        // 3. Coba ambil Kelompok
        $kelompok = \App\Models\kelompok_pjbl::find($kelompok_id);
        // dd($mapel, $siklus_pjbl, $kelompok);
        $anggota = anggota_kelompok::with([
            'user',
            'posisi',
            'user.penilaians' => function ($q) use ($mapel, $siklus_pjbl) {
                $q->whereHas('indikator', function ($sub) use ($mapel, $siklus_pjbl) {
                    $sub->where('id_mapel', $mapel->id)
                        ->where('id_siklus_pjbl', $siklus_pjbl->id);
                });
            }
        ])
            ->where('id_kelompok_pjbl', $kelompok->id)
            ->get();

        $indikator = indikator_penilaian::where('id_mapel', $mapel->id)
            ->where('id_siklus_pjbl', $siklus_pjbl->id)
            ->get();

        return view('guru.penilaian.index', compact(
            'anggota',
            'indikator',
            'kelompok',
            'mapel',
            'siklus_pjbl',

        ));
    }

    public function store(Request $request)
    {
        $user_id = $request->id_user;
        $indikator_ids = $request->indikator_ids ?? [];
        $nilai = $request->nilai ?? [];

        foreach ($indikator_ids as $id) {
            if (!isset($nilai[$id])) {
                continue;
            }

            Penilaian::updateOrCreate(
                [
                    'id_indikator' => $id,
                    'id_user' => $user_id,
                    'id_kuis' => $request->id_kuis ?? null, // kasih default null biar sesuai schema
                ],
                [
                    'nilai' => $nilai[$id],
                ]
            );
        }

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }
}
