<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Posisi;
use App\Models\siklus_pjbl;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function posisi($mapel_slug, $siklus_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus = siklus_pjbl::where('slug', $siklus_slug)
                    ->where('id_mapel', $mapel->id)
                    ->firstOrFail();
        // $posisi = Posisi::where('id_siklus_pjbl', $siklus->id)->get();
        

        // Ambil indikator berdasarkan siklus
        $posisi = Posisi::where('id_siklus_pjbl', $siklus->id)->get();

        // dd($indikators);
        return view('guru.pjbl.posisi', [
            'title' => 'Indikator',
            'mapel' => $mapel,
            // 'posisi' => $posisi,
            'siklus' => $siklus,
            'posisi' => $posisi,
        ]);
    }
public function store_posisi(Request $request)
{
    $request->validate([
        'id_mapel' => 'required|exists:mapels,id',
        'id_siklus_pjbl' => 'required|exists:siklus_pjbls,id',
        'nama_posisi' => 'required|string|max:255',
    ]);

    Posisi::create([
        'id_mapel' => $request->id_mapel,
        'id_siklus_pjbl' => $request->id_siklus_pjbl,
        'nama_posisi' => $request->nama_posisi,
    ]);

    return back()->with('success', 'Posisi berhasil ditambahkan');
}

    public function update_posisi(Request $request, $id)
    {
        $posisi = Posisi::findOrFail($id);
        $posisi->update($request->all());
        return back()->with('success', 'Posisi berhasil diupdate');
    }

    public function destroy_posisi($id)
    {
        $posisi = Posisi::findOrFail($id);
        $posisi->delete();
        return back()->with('success', 'Posisi berhasil dihapus');
    }

}
