<?php

namespace App\Http\Controllers;

use App\Models\mata_pelajaran;
use Illuminate\Http\Request;
use App\Models\materi;

class MateriController extends Controller
{
    public function siswa(mata_pelajaran $mapel)
    {
        // Ambil materi yang hanya milik mapel ini
        $materi = $mapel->materi;

        return view('siswa.materi.index', [
            'tittle' => 'Materi - ' . $mapel->nama_mapel,
            'materi' => $materi,
            'mapel' => $mapel
        ]);
    }

    public function guru(mata_pelajaran $mapel){
        $materi = $mapel->materi;

        return view('guru/materi/index', [
            'tittle' => 'Materi',
            'materi' => $materi,
            'mapel'=> $mapel
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_mapel' => 'required',
            'urutan_materi' => 'required|numeric',
            'judul_materi' => 'required|string|max:255',
            'deskripsi_materi' => 'required|string',
            'dokumen_materi' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan dokumen
        $file = $request->file('dokumen_materi');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen_materi', $fileName, 'public');

        materi::create([
            'id_mapel' => $request->id_mapel,
            'urutan_materi' => $request->urutan_materi,
            'judul' => $request->judul_materi,
            'deskripsi_materi' => $request->deskripsi_materi,
            'dokumen_materi' => $filePath,
        ]);

        return redirect()->back();
    }

    public function byMapel($id_mapel)
    {
        $materi = materi::where('id_mapel', $id_mapel)->get();

        return view('guru/materi/index', [
            'tittle' => 'Materi',
            'materi' => $materi
        ]);
    }
}
