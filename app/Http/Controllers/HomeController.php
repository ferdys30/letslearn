<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\kelompok_pjbl;
use App\Models\aktivitas_pjbl;
use App\Models\anggota_kelompok;
use App\Models\pengumpulan_tugas;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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

        $mapel = Mapel::where('id_kelas', $user->id_kelas)
                    ->get();

        return view('index', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

    public function guru()
    {
        // dd(Auth::check(), Auth::user()); // Tambahkan ini untuk debug
        $user = Auth::user();

        // Ambil semua mata pelajaran yang diajarkan oleh guru
        $mapelList = Mapel::where('id_user', $user->id)->get();

        // // $allkelompok_pjbl = collect();
        // // $allStudiKasus = collect();
        // // $allAnggota = collect();

        // // foreach ($mapelList as $mapel) {
        // //     $kelompok_pjbl = kelompok_pjbl::where('id_mapel', $mapel->id)->get();
        // //     $studiKasus = studi_kasus::where('id_mapel', $mapel->id)->get();
        // //     $kelompok_pjblIds = $kelompok_pjbl->pluck('id');
        // //     $anggota = anggota_kelompok::whereIn('id_kelompok_pjbl', $kelompok_pjblIds)->get();

        // //     foreach ($kelompok_pjbl as $klmpk) {
        // //         $totalSyntax = aktivitas_pjbl::where('id_mapel', $mapel->id)->count();
        // //         $pengumpulan_tugasCount = pengumpulan_tugas::where('id_kelompok_pjbl', $klmpk->id)
        // //             ->whereIn('id_aktivitas_pjbl', aktivitas_pjbl::where('id_mapel', $mapel->id)->pluck('id'))
        // //             ->count();
        // //         $klmpk->progress = $totalSyntax > 0 ? round(($pengumpulan_tugasCount / $totalSyntax) * 100, 2) : 0;
        // //     }

        // //     $allkelompok_pjbl = $allkelompok_pjbl->merge($kelompok_pjbl);
        // //     $allStudiKasus = $allStudiKasus->merge($studiKasus);
        // //     $allAnggota = $allAnggota->merge($anggota);
        // }

        // if (Schema::hasTable('pengumpulan_tugas')) {
        //     $pengumpulan_tugasBelumDivalidasi = pengumpulan_tugas::where('status', '1')->count();

        //     if ($pengumpulan_tugasBelumDivalidasi > 0) {
        //         session()->flash('pengumpulan_tugas_alert', "Ada $pengumpulan_tugasBelumDivalidasi pengumpulan tugas yang menunggu validasi.");
        //     }
        // }
        // dd($mapelList);
        return view('guru/index', [
            'tittle' => 'Dashboard',
            'mapelList' => $mapelList,
            // 'kelompok_pjbl' => $allkelompok_pjbl,
            // 'studi_kasus' => $allStudiKasus,
            // 'anggota' => $allAnggota
        ]);
    }

}
