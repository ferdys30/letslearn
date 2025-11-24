<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\indikator_penilaian;
use App\Models\studi_kasus;
use App\Models\siklus_pjbl;
use App\Models\anggota_kelompok;
use App\Models\pertemuan;
use App\Models\aktivitas_pjbl;
use App\Models\pengumpulan_tugas;
use App\Models\kelompok_pjbl;
use App\Models\tujuan_pembelajaran;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index(string $slug)
    {
        $mapel = Mapel::where('slug', $slug)->firstOrFail();
        // $mapel = Mapel::where('slug', $slug)->firstOrFail(); // otomatis 404 jika slug salah
        $siklus_pjbls = siklus_pjbl::where('id_mapel', $mapel->id)->get();
        // dd($mapel);
        // dd($mapel, $siklus_pjbls);

        return view('guru.mapel.index', [
            // 'mapelList' => [$mapel],
            'mapel' => $mapel,
            'siklus_pjbls' => $siklus_pjbls
        ]);
    }


    public function pertemuan(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        // $mapel = Mapel::where('slug', $slug)->firstOrFail(); // otomatis 404 jika slug salah
        // $user = Auth::user();

        // Ambil siklus_pjbls sesuai mapel
        $pertemuans = pertemuan::where('id_mapel', $mapel->id)->get() ?? collect();
        return view('guru.mapel.pertemuan', [
            'tittle' => 'Mata Pelajaran',
            'mapelList' => [$mapel], // tetap array agar konsisten
            'pertemuans' => $pertemuans,
            'mapel' => $mapel
        ]);
    }

    public function store_pertemuan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_mapel' => 'required|exists:mapels,id',
            'judul_pertemuan' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
        ]);

        // Simpan ke database
        Pertemuan::create([
            'id_mapel' => $validated['id_mapel'],
            'judul_pertemuan' => $validated['judul_pertemuan'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pertemuan berhasil ditambahkan.');
    }

    public function update_pertemuan(Request $request, $id)
    {
        // dd($request);
        $pertemuan = Pertemuan::findOrFail($id);
        $pertemuan->update([
            'judul_pertemuan' => $request->judul_pertemuan,
            'tanggal' => $request->tanggal,
            'id_mapel' => $request->id_mapel,
        ]);

        return redirect()->back()->with('success', 'Pertemuan berhasil diperbarui.');
    }

    public function destroy_pertemuan($id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        $pertemuan->delete();

        return redirect()->back()->with('success', 'Pertemuan berhasil dihapus.');
    }

    public function detail(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        // Ambil tujuan pembelajaran sesuai id_kelas dari mapel pertama
        $tujuan_pembelajaran = tujuan_pembelajaran::where('id_mapel', $mapel->id)->get();

        $indikator_penilaian = indikator_penilaian::where('id_mapel', $mapel->id)->get();

        // dd($tujuan_pembelajaran);
        // dd($mapel);
        return view('guru/mapel/detail', [
            'tittle' => 'kelompok_pjbl',
            'mapel' => $mapel,
            'indikator_penilaian' => $indikator_penilaian,
            'tujuan_pembelajaran' => $tujuan_pembelajaran,
        ]);
    }

    public function store_tp(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'tujuan_pembelajaran' => 'required',
        ]);
        // dd($validatedData);
        tujuan_pembelajaran::create($validatedData);

        return redirect()->back();
    }

    public function update_tp(Request $request, $id)
    {
        // dd($request,$id);
        $request->validate([
            'tujuan_pembelajaran' => 'required|string',
        ]);

        $tp = tujuan_pembelajaran::findOrFail($id);
        $tp->tujuan_pembelajaran = $request->tujuan_pembelajaran;
        $tp->save();

        return redirect()->back()->with('success', 'Tujuan pembelajaran berhasil diperbarui.');
    }


    public function update_deskripsi(Request $request, $id)
    {
        $request->validate([
            'deskripsi_mapel' => 'required|string|max:1000',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->deskripsi_mapel = $request->deskripsi_mapel;
        $mapel->save();

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil diperbarui.');
    }

    public function store_indikator(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'id_siklus_pjbl' => 'required',
            'indikator_penilaian' => 'required',
            'skema' => 'required',
            // 'id_posisi' => 'required',
            'nilai_maks' => 'required',
            'skala_1' => 'required',
            'skala_2' => 'required',
            'skala_3' => 'required',
            'skala_4' => 'required',
            // 'skala_5' => 'required',
        ]);
        // dd($validatedData);
        indikator_penilaian::create($validatedData);

        return redirect()->back();
    }

    public function update_indikator(Request $request, $id)
    {
        $request->validate([
            'indikator_penilaian' => 'required|string',
            'skema' => 'required|integer|in:1,2,3',
            'skala_1' => 'required|string',
            'skala_2' => 'required|string',
            'skala_3' => 'required|string',
            'skala_4' => 'required|string',
            'skala_5' => 'required|string',
        ]);

        $indikator = indikator_penilaian::findOrFail($id);
        $indikator->update($request->all());

        return redirect()->back()->with('success', 'Indikator berhasil diperbarui.');
    }

    public function destroy_indikator($id)
    {
        $indikator = indikator_penilaian::findOrFail($id);
        $indikator->delete();

        return redirect()->back()->with('success', 'Indikator berhasil dihapus.');
    }
}
