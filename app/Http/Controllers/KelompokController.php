<?php

namespace App\Http\Controllers;

use App\Models\kelompok;
use App\Models\pengumpulan;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\anggota_kelompok;
use App\Models\pjbl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
    public function kelompok(){
        $mapel = mata_pelajaran::first();
        $kelompok = kelompok::all();
        $anggota = anggota_kelompok::all();
        
        // dd($terkumpul->pjbl->urutan, $terkumpul->pjbl->slug);
        return view('siswa/pjbl/kelompok', [
            'tittle' => 'Project Based Learning',
            'mapel' => $mapel,
            'kelompok'=> $kelompok,
            'anggota' => $anggota,
        ]);
    }

    public function guru(){
        $mapel = mata_pelajaran::first();
        $kelompok = kelompok::where('id_kelas', $mapel->id_kelas)->get();
        $studi_kasus = studi_kasus::where('id_kelas', $mapel->id_kelas)->get();
        $anggota = anggota_kelompok::where('id_kelas', $mapel->id_kelas)->get();
        $pengumpulan = pengumpulan::where('id_kelas', $mapel->id_kelas)->get();

        foreach ($kelompok as $klmpk) {
            $totalSyntax = 8; // Jumlah total syntax yang diharapkan
            $pengumpulanCount = $klmpk->pengumpulan->count(); // Hitung jumlah pengumpulan
    
            // Hitung progres dalam persen
            $progress = ($pengumpulanCount / $totalSyntax) * 100;
            $klmpk->progress = round($progress, 2); // Simpan progres dengan dua angka desimal
        }

        return view('guru/kelompok/index', [
            'tittle' => 'Kelompok',
            'mapel' => $mapel,
            'kelompok'=> $kelompok,
            'anggota' => $anggota
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
            'nama_kelompok' => 'required',
            'jumlah_kelompok' => 'required'
        ]);

       DB::beginTransaction();

        try {
            // 1. Tambahkan data ke tabel kelompoks
            $kelompok = Kelompok::create([
                'id_mapel' => $request->id_mapel,
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

    public function gabung_kelompok(Request $request) {
        $request->validate([
            'id_kelompok' => 'required',
        ]);

        $idUser = Auth::id();

        // Cegah user gabung dua kali ke kelompok manapun
        $sudahGabung = anggota_kelompok::where('id_user', $idUser)->exists();
        if ($sudahGabung) {
            return back()->with('error', 'Kamu sudah tergabung dalam kelompok.');
        }

        anggota_kelompok::create([
            'id_kelompok' => $request->id_kelompok,
            'id_user' => $idUser
        ]);

        return redirect('/siswa/pjbl/kelompok')->with('success', 'Berhasil bergabung ke kelompok.');
    }


}
