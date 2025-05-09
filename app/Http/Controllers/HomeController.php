<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;

class HomeController extends Controller
{
    public function index(){
        $mapel = mata_pelajaran::first();

        return view('index', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

    public function guru(){
        return view('guru/index', ['tittle' => 'Dashboard']);
    }
}
