<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class pengumpulan_tugasController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_aktivitas_pjbl' => 'required|exists:aktivitas_pjbls,id',
            'id_anggota_kelompok' => 'required|exists:anggota_kelompok,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date|after_or_equal:today',
            'id_siklus_pjbl' => 'required|exists:siklus_pjbls,id',
        ]);

        Tugas::create([
            'id_siklus_pjbl' => $request->id_siklus_pjbl,
            'id_aktivitas_pjbl' => $request->id_aktivitas_pjbl,
            'id_anggota_kelompok' => $request->id_anggota_kelompok,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }
}
