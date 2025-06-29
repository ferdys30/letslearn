<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pjbl;
use App\Models\kelompok;
use App\Models\pengumpulan;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\mata_pelajaran;
use App\Models\penugasan;
use App\Models\tugas;
use App\Models\anggota_kelompok;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PjblController extends Controller
{
    public function index(mata_pelajaran $mapel)
    {
        $penugasans = Penugasan::where('id_mapel', $mapel->id)->get();
        // dd($penugasans);

        return view('siswa.pjbl.index', [
            'tittle' => 'Daftar Penugasan',
            'mapel' => $mapel,
            'penugasans' => $penugasans,
        ]);
    }

    public function pjbl(mata_pelajaran $mapel, Penugasan $penugasan)
    {
        $userId = Auth::id();

        $userKelompok = anggota_kelompok::where('id_user', $userId)->first();
        if (!$userKelompok) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok manapun.');
        }

        $idKelompok = $userKelompok->id_kelompok;

        $pjbls = pjbl::where('id_mapel', $mapel->id)
            ->where('id_penugasan', $penugasan->id)
            ->orderBy('urutan')
            ->get();

        $validPengumpulan = pengumpulan::where('id_kelompok', $idKelompok)
            ->where('status', 2)
            ->pluck('id_pjbl');

        $urutanValidTerakhir = pjbl::whereIn('id', $validPengumpulan)->max('urutan') ?? 0;

        $pjbls->map(function ($item) use ($urutanValidTerakhir) {
            $waktuMulai = Carbon::make($item->waktu_mulai) ?? now()->addYear();
            $item->terkunci = !($item->urutan == 1 || ($item->urutan <= $urutanValidTerakhir + 1 && now() >= $waktuMulai));
            return $item;
        });

        $pengumpulans = pengumpulan::where('id_kelompok', $idKelompok)->get()->keyBy('id_pjbl');

        $anggota_kelompok = anggota_kelompok::with('user', 'posisi') // tambah relasi 'posisi'
            ->where('id_kelompok', $idKelompok)
            ->get();

        return view('siswa/pjbl/pjbl', [
            'tittle' => 'Project Based Learning',
            'pjbls' => $pjbls,
            'anggota_kelompok' => $anggota_kelompok,
            'pengumpulans' => $pengumpulans,
            'mapel' => $mapel,
            'penugasan' => $penugasan,
        ]);
    }



    //syntax siswa
    public function syntax(Mata_pelajaran $mapel, Penugasan $penugasan, Pjbl $pjbl)
    {
        $userId = Auth::id();

        $userKelompok = anggota_kelompok::with('posisi')
            ->where('id_user', $userId)
            ->first();

        if (!$userKelompok) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok manapun.');
        }

        $idKelompok = $userKelompok->id_kelompok;
        $namaPosisi = $userKelompok->posisi->nama_posisi ?? 'anggota';

        $studi_kasus = studi_kasus::where('id_kelompok', $idKelompok)->get();

        $canCreateTugas = strtolower($namaPosisi) === 'ketua';

        $anggotaKelompok = anggota_kelompok::with(['user', 'posisi'])
            ->where('id_kelompok', $idKelompok)
            ->get();

        // Ambil semua tugas yang terkait dengan pjbl dan anggota kelompok ini
        $idAnggotaKelompok = $anggotaKelompok->pluck('id')->toArray();

        if (strtolower($namaPosisi) === 'ketua') {
            // Ketua melihat semua tugas kelompok
            $idAnggotaKelompok = $anggotaKelompok->pluck('id')->toArray();

            $tugas = tugas::where('id_pjbl', $pjbl->id)
                ->whereIn('id_anggota_kelompok', $idAnggotaKelompok)
                ->get();
        } else {
            // Anggota biasa hanya melihat tugas miliknya
            $tugas = tugas::where('id_pjbl', $pjbl->id)
                ->where('id_anggota_kelompok', $userKelompok->id)
                ->get();
        }

        if (!$penugasan || !$penugasan->id) {
            return redirect()->back()->with('error', 'Penugasan tidak ditemukan.');
        }

        // dd($tugas);
        return view('siswa/pjbl/syntax', [
            'tittle' => 'Project Based Learning',
            'mapel' => $mapel,
            'pjbl' => $pjbl,
            'studi_kasus' => $studi_kasus,
            'penugasan' => $penugasan,
            'kelompokUser' => $userKelompok,
            'canCreateTugas' => $canCreateTugas,
            'anggotaKelompok' => $anggotaKelompok,
            'tugas' => $tugas, // kirim data tugas ke view
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

        $pjbl = Pjbl::findOrFail($request->id_pjbl);
        $mapel = $pjbl->mata_pelajaran; // Pastikan kamu sudah punya relasi 'mapel()' di model Pjbl


        $validatedData = $request->validate([
            'id_kelompok' => 'required',
            'file_pengumpulan' => 'nullable|file',
            'id_pjbl' => 'required',
            'id_user' => 'required',
            'id_penugasan' => 'required',
            'deskriptif' => 'nullable|string',
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
           return back()->with('error', 'Kelompokmu sudah mengumpulkan tahap ini.');
        }

        pengumpulan::create($validatedData);
        
        return back()->with('success', 'Jawaban berhasil dikumpulkan!');
    }


}
