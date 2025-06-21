<?php

namespace App\Http\Controllers;

use App\Models\Pjbl;
use App\Models\kelompok;
use App\Models\pengumpulan;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\anggota_kelompok;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PjblController extends Controller
{
      
    public function index()
    {
        $userId = Auth::id();

        // Cek kelompok user
        $userKelompok = anggota_kelompok::where('id_user', $userId)->first();
        if (!$userKelompok) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok manapun.');
        }

        $idKelompok = $userKelompok->id_kelompok;

        // Ambil semua syntax PJBL
        $pjbls = pjbl::orderBy('urutan')->get();

        // Ambil semua pengumpulan valid milik kelompok
        $validPengumpulan = pengumpulan::where('id_kelompok', $idKelompok)
            ->where('status', 2)
            ->pluck('id_pjbl'); // Ambil ID PJBL yang sudah valid

        // Ambil urutan tertinggi yang sudah divalidasi
        $urutanValidTerakhir = pjbl::whereIn('id', $validPengumpulan)->max('urutan') ?? 0;

        // Tandai setiap PJBL apakah terkunci
        $pjbls->map(function ($item) use ($urutanValidTerakhir) 
        {
            $waktuMulai = \Carbon\Carbon::make($item->waktu_mulai) ?? now()->addYear(); // fallback jauh ke depan jika error

            if ($item->urutan == 1) {
                $item->terkunci = false;
            } else {
                $item->terkunci = $item->urutan > ($urutanValidTerakhir + 1) || now() < $waktuMulai;
            }

            return $item;
        });


        $pengumpulans = pengumpulan::where('id_kelompok', $idKelompok)->get()->keyBy('id_pjbl');

        // Ambil anggota kelompok ini (termasuk relasi user)
        $anggota_kelompok = anggota_kelompok::with('user')
            ->where('id_kelompok', $idKelompok)
            ->get();

        return view('siswa/pjbl/index', [
            'tittle' => 'Project Based Learning',
            'pjbls' => $pjbls,
            'anggota_kelompok' => $anggota_kelompok, // <-- ini ditambahkan
            'pengumpulans' => $pengumpulans, // <--- Tambahan
        ]);
    }

    //syntax siswa
    public function syntax(pjbl $pjbl)
    {
        $userId = Auth::id();

        // Cek apakah user sudah tergabung dalam kelompok
        $userKelompok = anggota_kelompok::where('id_user', $userId)->first();
        if (!$userKelompok) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok manapun.');
        }
        $idKelompok = $userKelompok->id_kelompok;
        // Ambil studi kasus milik kelompok
        $studi_kasus = studi_kasus::where('id_kelompok', $idKelompok)->get();

        return view('siswa/pjbl/syntax', [
            'tittle' => 'Project Based Learning',
            'pjbl' => $pjbl,
            'studi_kasus' => $studi_kasus,// studi kasus
            'kelompokUser' => $userKelompok, // <-- Tambahkan ini
        ]);
    }

    //pembacaan pjbl
    public function guru_syntax($namaKelompok)
    {
        // Ambil kelompok berdasarkan nama_kelompok
        $kelompok = kelompok::where('nama_kelompok', $namaKelompok)->firstOrFail();

        // Ambil mata pelajaran terkait kelompok
        $mapel = mata_pelajaran::findOrFail($kelompok->id_mapel);

        // Ambil semua PJBL terkait mata pelajaran
        $pjbls = Pjbl::where('id_mapel', $mapel->id)->orderBy('urutan')->get();

        // Ambil anggota kelompok
        $anggotaKelompok = anggota_kelompok::with('user')
            ->where('id_kelompok', $kelompok->id)
            ->get();

        $idKelompok = $kelompok->id;
            
        $pengumpulans = pengumpulan::where('id_kelompok', $idKelompok)->get()->keyBy('id_pjbl');

        return view('/guru/kelompok/detail', [
            'mapel' => $mapel,
            'kelompok' => $kelompok,
            'pjbls' => $pjbls,
            'anggotaKelompok' => $anggotaKelompok,
            'pengumpulans' => $pengumpulans, // <--- Tambahan
        ]);
    }

    //validasi pjbl
    public function validasiPengumpulan($id)
    {
        $pengumpulan = Pengumpulan::findOrFail($id);
        $pengumpulan->status = 2; // Validasi
        $pengumpulan->save();

        return back()->with('success', 'Pengumpulan berhasil divalidasi.');
    }



    //syntax pjbl guru
    public function syntax_guru(){
        $mapel =  mata_pelajaran::first();
        $syntax = pjbl::where('id_mapel', $mapel->id)->get();
        return view('guru/pjbl/syntax', [
            'tittle' => 'Syntax Project Based Learning',
            'syntax' => $syntax,
            'mapel' => $mapel
        ]);
    }
    // store syntax
    public function store_syntax(Request $request){
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'urutan' => 'required',
            'nama_syntax' => 'required',
            'slug' => 'required',
            'pengumpulan' => 'nullable',
            'penjelasan' => 'required', // kelas boleh kosong
            'waktu_mulai'=>'required',
            'waktu' => 'required',
        ]);
        // dd($validatedData);
        Pjbl::create($validatedData);
    
        return redirect('/guru/syntax')->with('success', 'Registrasi Berhasil, Silakan Login');
    }

    //menmbah studi_kasus
    public function studi_kasus(){
        $mapel =  mata_pelajaran::first();
        $studi_kasus = studi_kasus::where('id_mapel', $mapel->id)->get();
        $kelompok = kelompok::where('id_mapel', $mapel->id)->get();

        return view('guru/pjbl/index', [
            'tittle' => 'Studi Kasus Project Based Learning',
            'studi_kasus' => $studi_kasus,
            'mapel' => $mapel,
            'kelompok' => $kelompok,
        ]);
    }
    //store studi_kasus
    public function store_studi_kasus(Request $request){
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'id_kelompok' => 'required',
            'studi_kasus' => 'required',
        ]);
        // dd($validatedData);
        studi_kasus::create($validatedData);
    
        return redirect('/guru/pjbl/studi_kasus')->with('success', 'Registrasi Berhasil, Silakan Login');
    }

    public function diskusi(){
        return view('guru/pjbl/diskusi', ['tittle' => 'Diskusi']);
    }

    //siswa pengumpulan
    public function pengumpulan_siswa_syntax(Request $request)
    {
        Log::info('Form submit diterima', $request->all());

        $validatedData = $request->validate([
            'id_kelompok' => 'required',
            'id_pjbl' => 'required',
            'id_user' => 'required',
            'deskriptif' => 'nullable|string',
            'file_pengumpulan' => 'nullable|file',
        ]);

        $validatedData['status'] = 1;

        // Handle upload file jika ada
        if ($request->hasFile('file_pengumpulan')) {
            $file = $request->file('file_pengumpulan');
            $path = $file->store('pengumpulan_files', 'public');
            $validatedData['file_pengumpulan'] = $path;
        }
        
        $alreadySubmitted = pengumpulan::where('id_kelompok', $request->id_kelompok)
            ->where('id_pjbl', $request->id_pjbl)
            ->exists();

        if ($alreadySubmitted) {
            return redirect()->back()->with('error', 'Kelompokmu sudah mengumpulkan tahap ini.');
        }

        pengumpulan::create($validatedData);
        
        return redirect("/siswa/pjbl")->with('success', 'Jawaban berhasil dikumpulkan!');
    }


}
