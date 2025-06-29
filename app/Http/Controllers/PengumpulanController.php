<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class PengumpulanController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_pjbl' => 'required|exists:pjbls,id',
            'id_anggota_kelompok' => 'required|exists:anggota_kelompoks,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date|after_or_equal:today',
            'id_penugasan' => 'required|exists:penugasans,id',
        ]);

        Tugas::create([
            'id_penugasan' => $request->id_penugasan,
            'id_pjbl' => $request->id_pjbl,
            'id_anggota_kelompok' => $request->id_anggota_kelompok,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }


}
