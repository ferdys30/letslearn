<?php

namespace App\Http\Controllers;

use App\Models\aktivitas_pjbl;
use App\Models\Posisi;
use App\Models\kelompok_pjbl;
use App\Models\siklus_pjbl;
use App\Models\pengumpulan_tugas;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\anggota_kelompok;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class kelompok_pjblController extends Controller
{
    public function kelompok_pjbl(Mapel $mapel, siklus_pjbl $siklus_pjbl)
    {
        $user = Auth::user();

        // Cek akses kelas
        if ($mapel->id_kelas !== $user->id_kelas) {
            abort(403, 'Anda tidak memiliki akses ke mata pelajaran ini.');
        }

        // Cek siklus_pjbl sesuai mapel
        if ($siklus_pjbl->id_mapel !== $mapel->id) {
            abort(403, 'Siklus PJBl tidak valid untuk mata pelajaran ini.');
        }

        $posisi = Posisi::where('id_mapel', $mapel->id)->get();

        $kelompok_pjbl = kelompok_pjbl::with(['siklus_pjbl.mapel'])
            ->where('id_siklus_pjbl', $siklus_pjbl->id)
            ->where('id_kelas', $user->id_kelas)
            ->where('paralel', $user->paralel)
            ->whereHas('siklus_pjbl.mapel', function ($query) use ($user) {
                $query->where('id_kelas', $user->id_kelas);
            })
            ->get();

        // dd($kelompok_pjbl);

        $anggota = anggota_kelompok::with('user')
            ->whereIn('id_kelompok_pjbl', $kelompok_pjbl->pluck('id'))
            ->get();

        $userkelompok_pjbl = $anggota->firstWhere('id_user', $user->id)?->id_kelompok_pjbl;

        return view('siswa/aktivitas_pjbl/kelompok_pjbl', [
            'tittle' => 'kelompok_pjbl',
            'mapel' => $mapel,
            'kelompok_pjbl' => $kelompok_pjbl,
            'anggota'=> $anggota,
            'userkelompok_pjbl' => $userkelompok_pjbl,
            'siklus_pjbl' => $siklus_pjbl,
            'posisi' => $posisi
        ]);
    }



    public function guru(Mapel $mapel)
    {
        // Ambil semua data yang berkaitan dengan mapel
        $kelompok_pjbl = kelompok_pjbl::with(['studi_kasus', 'anggota_kelompok', 'pengumpulan_tugas']) // Eager load relasi
            ->where('id_mapel', $mapel->id)
            ->get();

        // Hitung progress untuk tiap kelompok_pjbl
        foreach ($kelompok_pjbl as $klmpk) {
            $totalSyntax = 8; // Jumlah maksimal yang diharapkan
            $pengumpulan_tugasCount = $klmpk->pengumpulan_tugas->count();
            $progress = ($pengumpulan_tugasCount / $totalSyntax) * 100;
            $klmpk->progress = round($progress, 2);
        }

        return view('guru.kelompok.index', [
            'tittle' => 'kelompok_pjbl',
            'mapel' => $mapel,
            'kelompok_pjbl' => $kelompok_pjbl
        ]);
    }



    public function store_kelompok_pjbl(Request $request){
        // dd($request);
        // Hitung jumlah kelompok_pjbl yang sudah ada untuk mapel ini
        $jumlahkelompok_pjbl = kelompok_pjbl::where('id_siklus_pjbl', $request->id_siklus_pjbl)->count();

        if ($jumlahkelompok_pjbl >= 11) {
            return redirect()->back()->with('error', 'Jumlah kelompok_pjbl maksimal adalah 11.');
        }

        // Cek apakah user sudah tergabung dalam kelompok pada siklus yang sama
        $user = Auth::user();

        // Cek apakah user sudah tergabung dalam kelompok pada siklus yang sama
        $sudah_tergabung = anggota_kelompok::whereHas('kelompok_pjbl', function ($query) use ($request) {
            $query->where('id_siklus_pjbl', $request->id_siklus_pjbl);
        })->where('id_user', $user->id)->exists();

        if ($sudah_tergabung) {
            return redirect()->back()->with('error', 'Anda sudah tergabung dalam salah satu kelompok pada siklus ini.');
        }

        // $id_kelas = Auth::user()->id_kelas;

        $request->validate([
            'id_mapel' => 'required',
            'id_siklus_pjbl' => 'required',
            'nama_kelompok_pjbl' => 'required',
            'jumlah_kelompok_pjbl' => 'required'
        ]);

       DB::beginTransaction();

        try {
            // 1. Tambahkan data ke tabel kelompok_pjbl
            $kelompok_pjbl = kelompok_pjbl::create([
                'id_mapel' => $request->id_mapel,
                'id_siklus_pjbl' => $request->id_siklus_pjbl,
                'id_kelas' => $user->id_kelas,
                'paralel' => $user->paralel,
                'nama_kelompok_pjbl' => $request->nama_kelompok_pjbl,
                'jumlah_kelompok_pjbl' => $request->jumlah_kelompok_pjbl,
            ]);

            // 2. Tambahkan user login sebagai anggota pertama
            anggota_kelompok::create([
                'id_kelompok_pjbl' => $kelompok_pjbl->id,
                'id_user' => Auth::id(),
                'id_posisi' => 1, // Sesuaikan default posisi ID (misalnya ketua atau anggota biasa)
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'kelompok_pjbl berhasil dibuat dan Anda menjadi anggota pertama.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat kelompok_pjbl: ' . $e->getMessage());
        }
    }

    public function gabung_kelompok_pjbl(Request $request) 
    {
        $request->validate([
            'id_kelompok_pjbl' => 'required|exists:kelompok_pjbl,id',
            'id_posisi' => 'required|exists:posisis,id',
        ]);

        $idUser = Auth::id();

        $kelompok_pjblTujuan = kelompok_pjbl::findOrFail($request->id_kelompok_pjbl);
        $idMapelTujuan = $kelompok_pjblTujuan->id_mapel;
        $idsiklus_pjblTujuan = $kelompok_pjblTujuan->id_siklus_pjbl;

        // Cek apakah user sudah tergabung dalam kelompok_pjbl lain di siklus_pjbl yang sama
        $sudahGabung = DB::table('anggota_kelompok')
            ->join('kelompok_pjbl', 'anggota_kelompok.id_kelompok_pjbl', '=', 'kelompok_pjbl.id')
            ->where('anggota_kelompok.id_user', $idUser)
            ->where('kelompok_pjbl.id_mapel', $idMapelTujuan)
            ->where('kelompok_pjbl.id_siklus_pjbl', $idsiklus_pjblTujuan)
            ->exists();

        if ($sudahGabung) {
            return back()->with('error', 'Kamu sudah tergabung dalam kelompok_pjbl untuk siklus_pjbl ini.');
        }

        anggota_kelompok::create([
            'id_kelompok_pjbl' => $request->id_kelompok_pjbl,
            'id_user' => $idUser,
            'id_posisi' => $request->id_posisi
        ]);

        return redirect()->back()->with('success', 'Berhasil bergabung ke kelompok_pjbl.');
    }




}
