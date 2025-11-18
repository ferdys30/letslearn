<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function guru() {
        $guruList = User::where('id_role', 2)->get();
        return view('admin.guru', [
            'tittle' => 'Data Guru',
            'guruList' => $guruList,
        ]);
    }
    public function update_guru(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|numeric',
            'email' => 'nullable|email',
            'username' => 'required|string|max:255',
        ]);

        $guru = User::findOrFail($id);

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return redirect()->back()->with('success', 'Data guru berhasil diperbarui.');
    }

    public function resetPassword($id)
    {
        $guru = user::findOrFail($id);

        $newPassword = $guru->nip ?? $guru->username; // fallback kalau NIP kosong
        $guru->password = Hash::make($newPassword);
        $guru->save();

        return redirect()->back()->with('success', 'Password berhasil direset.');
    }

    public function siswa() {
        $siswaList = User::where('id_role', 3)->get();
        return view('admin.siswa', [
            'tittle' => 'Data Guru',
            'siswaList' => $siswaList,
        ]);
    }

    public function update_siswa(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'nullable|numeric',
            'email' => 'nullable|email',
            'username' => 'required|string|max:255',
        ]);

        $Siswa = User::findOrFail($id);

        $Siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return redirect()->back()->with('success', 'Data Siswa berhasil diperbarui.');
    }

    public function resetPassword_siswa($id)
    {
        $siswa = user::findOrFail($id);

        $newPassword = $siswa->nis ?? $siswa->username; // fallback kalau NIP kosong
        $siswa->password = Hash::make($newPassword);
        $siswa->save();

        return redirect()->back()->with('success', 'Password berhasil direset.');
    }

    public function mapel() {
        // Ambil semua guru dari user yang memiliki id_role = 3
        $gurus = User::where('id_role', 2)->get();

        // Ambil semua kelas
        $kelas = Kelas::all();
        $mapels = Mapel::with(['users', 'kelas'])->get();
        return view('admin.mapel', [
            'tittle' => 'Data Mata Pelajaran',
            'mapels' => $mapels,
            'gurus' => $gurus,
            'kelas' => $kelas,
        ]);
    }

    public function store_mapel(Request $request) {
        // Ambil semua guru dari user yang memiliki id_role = 3
        // dd($request);
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kelas' => 'required|exists:kelas,id',
            'nama_mapel' => 'required|string|max:255',
            'deskripsi_mapel' => 'required|string',
        ]);

        Mapel::create([
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
            'nama_mapel' => $request->nama_mapel,
            'slug' => Str::slug($request->nama_mapel),
            'deskripsi_mapel' => $request->deskripsi_mapel,
        ]);

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function update_mapel(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'deskripsi_mapel' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $mapel = Mapel::findOrFail($id);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'slug' => Str::slug($request->nama_mapel),
            'deskripsi_mapel' => $request->deskripsi_mapel,
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->back()->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy_mapel($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();
        return redirect()->back()->with('success', 'Mapel berhasil dihapus.');
    }

    public function kelas() {
        // Ambil semua kelas
        $kelas = Kelas::withCount('users')->get();
        return view('admin.kelas', [
            'tittle' => 'Data Kelas',
            'kelas' => $kelas,
        ]);
    }

    public function store_kelas(Request $request) {
        // Ambil semua guru dari user yang memiliki id_role = 3
        // dd($request);
        $request->validate([
        'kelas' => 'required|string|max:255',
        ]);

        Kelas::create([
            'Kelas' => $request->kelas,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }


    public function destroy_kelas($id)
    {
        $kelas = kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function paralel_kelas(Kelas $kelas)
    {
        $paralels = User::where('id_kelas', $kelas->id)
            ->where('id_role', 3)
            ->whereNotNull('paralel')
            ->groupBy('paralel')
            ->select('paralel', DB::raw('count(*) as jumlah'))
            ->get();

        return view('admin.paralel', [
            'kelas' => $kelas,
            'paralels' => $paralels
        ]);
    }
    public function pilihNaikKelas(Kelas $kelas) {
        $siswa = User::where('id_kelas', $kelas->id)
                    ->where('id_role', 3) // asumsi 3 = role siswa
                    ->get();

        $kelasTujuan = Kelas::where('id', '!=', $kelas->id)->get();

        return view('admin.naikkan', [
            'kelas' => $kelas,
            'siswa' => $siswa,
            'kelasTujuan' => $kelasTujuan
        ]);
    }

    // Proses kenaikan
    public function prosesNaikKelas(Request $request) {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_tujuan' => 'required|exists:kelas,id',
        ]);

        User::whereIn('id', $request->siswa_id)->update([
            'id_kelas' => $request->kelas_tujuan
        ]);

        return redirect()->route('kelas.index')->with('success', 'Siswa berhasil dinaikkan kelas.');
    }
    
}
