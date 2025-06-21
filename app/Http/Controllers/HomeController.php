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
    public function index(){
        $mapel = mata_pelajaran::first();

        return view('index', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel
        ]);
    }

    public function guru()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil mata pelajaran berdasarkan guru yang login
        $mapel = mata_pelajaran::where('id_user', $user->id)->first();

        if (!$mapel) {
            return back()->with('error', 'Mata pelajaran belum ditambahkan untuk guru ini.');
        }

        // Ambil data terkait kelas
        $kelompok = Kelompok::where('id_mapel', $mapel->id)->get();
        $studi_kasus = studi_kasus::where('id_mapel', $mapel->id)->get();

        // Ambil semua ID kelompok dari mapel tersebut
        $kelompokIds = $kelompok->pluck('id');

        // Ambil anggota berdasarkan id_kelompok
        $anggota = anggota_kelompok::whereIn('id_kelompok', $kelompokIds)->get();

        // Hitung progres per kelompok
        foreach ($kelompok as $klmpk) {
            // Total syntax berdasarkan id_mapel yang sesuai
            $totalSyntax = pjbl::where('id_mapel', $mapel->id)->count();

            // Jumlah pengumpulan valid (opsional: status = 2 jika validasi penting)
            $pengumpulanCount = pengumpulan::where('id_kelompok', $klmpk->id)
                                    ->whereIn('id_pjbl', pjbl::where('id_mapel', $mapel->id)->pluck('id'))
                                    ->count();

            // Hitung progres
            $klmpk->progress = $totalSyntax > 0 ? round(($pengumpulanCount / $totalSyntax) * 100, 2) : 0;
        }

        // Ambil semua pengumpulan yang masih menunggu validasi
        $pengumpulanBelumDivalidasi = Pengumpulan::where('status', '1')->count();

        if ($pengumpulanBelumDivalidasi > 0) {
            // Menambahkan flash message untuk guru jika ada pengumpulan baru yang menunggu validasi
            session()->flash('pengumpulan_alert', "Ada $pengumpulanBelumDivalidasi pengumpulan tugas yang menunggu validasi.");
        }

        // dd($kelompok);
        return view('guru/index', [
            'tittle' => 'Dashboard',
            'mapel' => $mapel,
            'kelompok' => $kelompok,
            'studi_kasus' => $studi_kasus,
            'anggota' => $anggota
        ]);
    }
}
