<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\tujuan_pembelajaran;
use App\Models\indikator_penilaian;

class MataPelajaranController extends Controller
{
    public function mapel(){
        $mapel =  mata_pelajaran::first();
         // Ambil tujuan pembelajaran sesuai id_kelas dari mapel pertama
        $tujuan_pembelajaran = tujuan_pembelajaran::where('id_mapel', $mapel->id)->get();
        $indikator_penilaian = indikator_penilaian::where('id_mapel', $mapel->id)->get();
        // dd($tujuan_pembelajaran);
        // dd($mapel);
        return view('guru/mapel/index', [
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

        return redirect('/guru/mapel');
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

        return redirect('/guru/mapel');
    }
}
