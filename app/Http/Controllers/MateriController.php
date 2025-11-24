<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Models\materi;

class MateriController extends Controller
{
    public function siswa(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $materi = $mapel->materi;

        return view('siswa.materi.index', [
            'tittle' => 'Materi - ' . $mapel->nama_mapel,
            'materi' => $materi,
            'mapel' => $mapel
        ]);
    }

    public function guru(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        // Cek apakah Mapel berhasil dibinding (Anda sudah konfirmasi ini berhasil)
        // dd($mapel); 

        // Cek apakah relasi Materi berhasil dimuat
        $materi = $mapel->materi;

        // Cek apakah variabel $materi berisi data.
        // dd($materi); // Jika ini mengembalikan Collection kosong (count: 0) atau null, berarti tidak ada data materi untuk mapel ini.

        return view('guru/materi/index', [
            'tittle' => 'Materi',
            'materi' => $materi,
            'mapel' => $mapel
        ]);
    }

    
    public function store_materi(Request $request)
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

    public function update_materi(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);
        $materi->judul = $request->judul_materi;
        $materi->urutan_materi = $request->urutan_materi;
        $materi->deskripsi_materi = $request->deskripsi_materi;
        // handle dokumen_materi jika diperlukan
        $materi->save();

        return redirect()->back()->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy_materi($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
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
