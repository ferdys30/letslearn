<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuisController extends Controller
{
    //slugg
    public function siswa(){
        return view('siswa/kuis/index', ['tittle' => 'Kuis']);
    }

    public function kuis(){
        return view('guru/kuis/index', ['tittle' => 'Kuis']);
    }
    public function soal(Kuis $kuis){
        return view('guru/kuis/soal', ['tittle' => 'Tambahkan Soal']);
    }
}
