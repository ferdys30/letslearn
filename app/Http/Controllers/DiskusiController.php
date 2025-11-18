<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\diskusi;
use App\Models\pengumpulan_tugas;

class DiskusiController extends Controller
{

    public function revisi($id)
    {
        request()->validate([
            'komentar_revisi' => 'required|string'
        ]);

        $pengumpulan = Pengumpulan_Tugas::findOrFail($id);

        // Status revisi
        $pengumpulan->status = 3;
        $pengumpulan->save();

        // Masukkan pesan revisi ke tabel diskusi
        Diskusi::create([
            'id_kelompok_pjbl' => $pengumpulan->id_kelompok_pjbl,
            'id_aktivitas_pjbl' => $pengumpulan->id_aktivitas_pjbl,
            'id_user' => \Illuminate\Support\Facades\Auth::id(),
            'pesan_diskusi' => request('komentar_revisi'),
        ]);

        return back()->with('success', 'Revisi berhasil dikirim.');
    }
}
