<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pjbl;
use App\Models\mata_pelajaran;
use App\Models\studi_kasus;
use App\Models\kelompok;

class PjblController extends Controller
{
      
    //syntax siswa
    public function syntax(pjbl $pjbl)
    {
        $next = pjbl::where('id', '>', $pjbl->id)->orderBy('id')->first();
        
        // Lengkapi bagian ini sesuai kebutuhan
        $studi_kasus = studi_kasus::where('id_kelompok', /* nilai atau parameter di sini */)->get();

        return view('siswa/pjbl/index', [
            'tittle' => 'Project Based Learning',
            'pjbl' => $pjbl,
            'next_slug' => $next?->slug,
            'studi_kasus' => $studi_kasus,
        ]);
    }

    //syntax guru
    public function syntax_guru(){
        $mapel =  mata_pelajaran::first();
        $syntax = pjbl::where('id_mapel', $mapel->id)->get();
        return view('guru/pjbl/syntax', [
            'tittle' => 'Syntax Project Based Learning',
            'syntax' => $syntax,
            'mapel' => $mapel
        ]);
    }

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

    public function diskusi(){
        return view('guru/pjbl/diskusi', ['tittle' => 'Diskusi']);
    }

    public function store_syntax(Request $request){
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'urutan' => 'required',
            'nama_syntax' => 'required',
            'slug' => 'required|unique',
            'pengumpulan' => 'nullable',
            'penjelasan' => 'required', // kelas boleh kosong
            'waktu' => 'required',
        ]);
        // dd($validatedData);
        Pjbl::create($validatedData);
    
        return redirect('/guru/syntax')->with('success', 'Registrasi Berhasil, Silakan Login');
    }
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
}
