<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(){
        return view('guru/penilaian/index', ['tittle' => 'Penilaian']);

    }

    public function siswa(User $user){
        return view('guru/penilaian/siswa', ['tittle' => 'Penilaian Siswa']);

    }
}
