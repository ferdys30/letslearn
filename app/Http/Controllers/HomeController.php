<?php

namespace App\Http\Controllers;

use App\Models\kelompok;
use App\Models\pengumpulan;
use App\Models\studi_kasus;
use App\Models\pjbl;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\anggota_kelompok;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        if (!$user) {
            // Redirect, tampilkan view tamu, atau beri data default
            return view('index', [
                'tittle' => 'Dashboard',
                'mapel' => collect() // kosongkan koleksi agar tidak error di blade
            ]);
        }

        $mapel = mata_pelajaran::where('kelas', $user->kelas)
                    ->get();

        return view('index', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

    public function guru()
    {
        $user = Auth::user();

        // Ambil semua mata pelajaran yang diajarkan oleh guru
        $mapelList = mata_pelajaran::where('id_user', $user->id)->get();

        if ($mapelList->isEmpty()) {
            return back()->with('error', 'Belum ada mata pelajaran yang ditambahkan untuk guru ini.');
        }

        $allKelompok = collect();
        $allStudiKasus = collect();
        $allAnggota = collect();

        foreach ($mapelList as $mapel) {
            $kelompok = Kelompok::where('id_mapel', $mapel->id)->get();
            $studiKasus = studi_kasus::where('id_mapel', $mapel->id)->get();
            $kelompokIds = $kelompok->pluck('id');
            $anggota = anggota_kelompok::whereIn('id_kelompok', $kelompokIds)->get();

            foreach ($kelompok as $klmpk) {
                $totalSyntax = pjbl::where('id_mapel', $mapel->id)->count();
                $pengumpulanCount = pengumpulan::where('id_kelompok', $klmpk->id)
                    ->whereIn('id_pjbl', pjbl::where('id_mapel', $mapel->id)->pluck('id'))
                    ->count();
                $klmpk->progress = $totalSyntax > 0 ? round(($pengumpulanCount / $totalSyntax) * 100, 2) : 0;
            }

            $allKelompok = $allKelompok->merge($kelompok);
            $allStudiKasus = $allStudiKasus->merge($studiKasus);
            $allAnggota = $allAnggota->merge($anggota);
        }

        $pengumpulanBelumDivalidasi = pengumpulan::where('status', '1')->count();

        if ($pengumpulanBelumDivalidasi > 0) {
            session()->flash('pengumpulan_alert', "Ada $pengumpulanBelumDivalidasi pengumpulan tugas yang menunggu validasi.");
        }

        return view('guru/index', [
            'tittle' => 'Dashboard',
            'mapelList' => $mapelList,
            'kelompok' => $allKelompok,
            'studi_kasus' => $allStudiKasus,
            'anggota' => $allAnggota
        ]);
    }

}
