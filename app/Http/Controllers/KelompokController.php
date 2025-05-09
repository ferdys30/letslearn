<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\kelompok;
use App\Models\anggota_kelompok;
use App\Models\studi_kasus;
use App\Models\pengumpulan;

class KelompokController extends Controller
{
    public function kelompok(){
        $mapel = mata_pelajaran::first();
        $kelompok = kelompok::all();
        $anggota = anggota_kelompok::all();
    
    
        return view('siswa/pjbl/kelompok', [
            'tittle' => 'Project Based Learning',
            'mapel' => $mapel,
            'kelompok'=> $kelompok,
            'anggota' => $anggota
        ]);
    }

    public function guru(){
        $mapel = mata_pelajaran::first();
        $kelompok = kelompok::where('id_kelas', $mapel->id_kelas)->get();
        $studi_kasus = studi_kasus::where('id_kelas', $mapel->id_kelas)->get();
        $anggota = anggota_kelompok::where('id_kelas', $mapel->id_kelas)->get();
        $pengumpulan = pengumpulan::where('id_kelas', $mapel->id_kelas)->get();

        foreach ($kelompok as $klmpk) {
            $totalSyntax = 8; // Jumlah total syntax yang diharapkan
            $pengumpulanCount = $klmpk->pengumpulan->count(); // Hitung jumlah pengumpulan
    
            // Hitung progres dalam persen
            $progress = ($pengumpulanCount / $totalSyntax) * 100;
            $klmpk->progress = round($progress, 2); // Simpan progres dengan dua angka desimal
        }

        return view('guru/pjbl/kelompok', [
            'tittle' => 'Kelompok',
            'mapel' => $mapel,
            'kelompok'=> $kelompok,
            'anggota' => $anggota
        ]);
    }
}
