<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;

class KelasController extends Controller
{
    public function fitur(Request $request,$slug)
    {
        $mapel =mata_pelajaran::where('slug', $slug)->firstOrFail();
        return view('siswa.kelas.fitur', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

}
