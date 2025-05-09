<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    public function siswa(){
        return view('siswa/materi/index', ['tittle' => 'Materi']);
    }

    public function guru(){
        $materi = materi::all();

        return view('guru/materi/index', [
            'tittle' => 'Materi',
            'materi' => $materi
        ]);

    }
}
