<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $fitur = $request->query('fitur'); // menangkap 'kuis', 'materi', 'aktivitas_pjbl'
        
        $user = Auth::user();

        // Ambil semua mapel yang sesuai id_kelas user
        $mapel = Mapel::where('id_kelas', $user->id_kelas)->get();
        // dd($mapel);

        return view('siswa.kelas.index', [
            'tittle' => 'Pilih Kelas',
            'fitur' => $fitur,
            'mapelList' => $mapel
        ]);
    }

    public function fitur(Request $request,$slug)
    {
        $mapel =Mapel::where('slug', $slug)->firstOrFail();
        return view('siswa.kelas.fitur', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

}
