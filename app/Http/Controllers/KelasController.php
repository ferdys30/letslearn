<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $fitur = $request->query('fitur'); // menangkap 'kuis', 'materi', 'pjbl'

        $user = Auth::user();


        // Ambil semua mapel yang sesuai kelas user
        $mapel = mata_pelajaran::where('kelas', $user->kelas)
                    ->get();

        return view('siswa.kelas.index', [
            'tittle' => 'Pilih Kelas',
            'fitur' => $fitur,
            'mapelList' => $mapel
        ]);
    }

    public function fitur(Request $request,$slug)
    {
        $mapel =mata_pelajaran::where('slug', $slug)->firstOrFail();
        return view('siswa.kelas.fitur', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

}
