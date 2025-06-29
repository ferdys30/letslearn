<?php

namespace App\Http\Controllers;

use App\Models\pjbl;
use App\Models\Posisi;
use App\Models\kelompok;
use App\Models\penugasan;
use App\Models\pengumpulan;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\anggota_kelompok;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
    public function kelompok(mata_pelajaran $mapel, Penugasan $penugasan)
    {
        $user = Auth::user();

        // Cek akses kelas
        if ("$mapel->kelas" !== $user->kelas || $mapel->kelas_detail !== $user->kelas_detail) {
            abort(403, 'Anda tidak memiliki akses ke mata pelajaran ini.');
        }

        // Cek penugasan sesuai mapel
        if ($penugasan->id_mapel !== $mapel->id) {
            abort(403, 'Penugasan tidak valid untuk mata pelajaran ini.');
        }

        $posisi = Posisi::where('id_mapel', $mapel->id)->get();

        // Kelompok untuk penugasan ini
        $kelompok = Kelompok::with('penugasan')
            ->where('id_mapel', $mapel->id)
            ->where('id_penugasan', $penugasan->id)
            ->get();

        $anggota = anggota_kelompok::with('user')
            ->whereIn('id_kelompok', $kelompok->pluck('id'))
            ->get();

        $userKelompok = $anggota->firstWhere('id_user', $user->id)?->id_kelompok;

        return view('siswa/pjbl/kelompok', [
            'tittle' => 'Kelompok',
            'mapel' => $mapel,
            'kelompok' => $kelompok,
            'anggota'=> $anggota,
            'userKelompok' => $userKelompok,
            'penugasan' => $penugasan,
            'posisi' => $posisi
        ]);
    }



    public function guru(mata_pelajaran $mapel)
    {
        // Ambil semua data yang berkaitan dengan mapel
        $kelompoks = kelompok::with(['studi_kasus', 'anggota_kelompok', 'pengumpulan']) // Eager load relasi
            ->where('id_mapel', $mapel->id)
            ->get();

        // Hitung progress untuk tiap kelompok
        foreach ($kelompoks as $klmpk) {
            $totalSyntax = 8; // Jumlah maksimal yang diharapkan
            $pengumpulanCount = $klmpk->pengumpulan->count();
            $progress = ($pengumpulanCount / $totalSyntax) * 100;
            $klmpk->progress = round($progress, 2);
        }

        return view('guru.kelompok.index', [
            'tittle' => 'Kelompok',
            'mapel' => $mapel,
            'kelompok' => $kelompoks
        ]);
    }



    public function store_kelompok(Request $request){
        // Hitung jumlah kelompok yang sudah ada untuk mapel ini
        $jumlahKelompok = kelompok::where('id_mapel', $request->id_mapel)->count();

        if ($jumlahKelompok >= 11) {
            return redirect()->back()->with('error', 'Jumlah kelompok maksimal adalah 11.');
        }

        $request->validate([
            'id_mapel' => 'required',
            'id_penugasan' => 'required',
            'nama_kelompok' => 'required',
            'jumlah_kelompok' => 'required'
        ]);

       DB::beginTransaction();

        try {
            // 1. Tambahkan data ke tabel kelompoks
            $kelompok = Kelompok::create([
                'id_mapel' => $request->id_mapel,
                'id_penugasan' => $request->id_penugasan,
                'nama_kelompok' => $request->nama_kelompok,
                'jumlah_kelompok' => $request->jumlah_kelompok,
            ]);

            // 2. Tambahkan user login sebagai anggota pertama
            anggota_kelompok::create([
                'id_kelompok' => $kelompok->id,
                'id_user' => Auth::id(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Kelompok berhasil dibuat dan Anda menjadi anggota pertama.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat kelompok: ' . $e->getMessage());
        }
    }

    public function gabung_kelompok(Request $request) 
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompoks,id',
            'id_posisi' => 'required|exists:posisis,id',
        ]);

        $idUser = Auth::id();

        $kelompokTujuan = Kelompok::findOrFail($request->id_kelompok);
        $idMapelTujuan = $kelompokTujuan->id_mapel;
        $idPenugasanTujuan = $kelompokTujuan->id_penugasan;

        // Cek apakah user sudah tergabung dalam kelompok lain di penugasan yang sama
        $sudahGabung = DB::table('anggota_kelompoks')
            ->join('kelompoks', 'anggota_kelompoks.id_kelompok', '=', 'kelompoks.id')
            ->where('anggota_kelompoks.id_user', $idUser)
            ->where('kelompoks.id_mapel', $idMapelTujuan)
            ->where('kelompoks.id_penugasan', $idPenugasanTujuan)
            ->exists();

        if ($sudahGabung) {
            return back()->with('error', 'Kamu sudah tergabung dalam kelompok untuk penugasan ini.');
        }

        anggota_kelompok::create([
            'id_kelompok' => $request->id_kelompok,
            'id_user' => $idUser,
            'id_posisi' => $request->id_posisi
        ]);

        return redirect()->back()->with('success', 'Berhasil bergabung ke kelompok.');
    }




}
