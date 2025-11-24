<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\aktivitas_pjbl;
use App\Models\kelompok_pjbl;
use App\Models\pengumpulan_tugas;
use App\Models\studi_kasus;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\siklus_pjbl;
use App\Models\diskusi;
use App\Models\tugas;
use App\Models\anggota_kelompok;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class aktivitas_pjblController extends Controller
{
    public function index(string $mapel_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus_pjbls = siklus_pjbl::where('id_mapel', $mapel->id)->get();
        // dd($siklus_pjbls);

        return view('siswa.aktivitas_pjbl.index', [
            'tittle' => 'Daftar siklus_pjbl',
            'mapel' => $mapel,
            'siklus_pjbls' => $siklus_pjbls,
        ]);
    }

    public function aktivitas_pjbl(string $mapel_slug, string $siklus_pjbl_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus_pjbl = \App\Models\siklus_pjbl::where('slug', $siklus_pjbl_slug)->firstOrFail();
        $userId = Auth::id();

        $userkelompok_pjbl = anggota_kelompok::where('id_user', $userId)->first();
        if (!$userkelompok_pjbl) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok_pjbl manapun.');
        }

        $idkelompok_pjbl = $userkelompok_pjbl->id_kelompok_pjbl;

        $aktivitas_pjbls = aktivitas_pjbl::where('id_mapel', $mapel->id)
            ->where('id_siklus_pjbl', $siklus_pjbl->id)
            ->orderBy('urutan')
            ->get();

        $validpengumpulan_tugas = pengumpulan_tugas::where('id_kelompok_pjbl', $idkelompok_pjbl)
            ->where('status', 2)
            ->pluck('id_aktivitas_pjbl');

        $urutanValidTerakhir = aktivitas_pjbl::whereIn('id', $validpengumpulan_tugas)->max('urutan') ?? 0;

        $aktivitas_pjbls->map(function ($item) use ($urutanValidTerakhir) {
            $waktuMulai = Carbon::make($item->waktu_mulai) ?? now()->addYear();
            $item->terkunci = !($item->urutan == 1 || ($item->urutan <= $urutanValidTerakhir + 1 && now() >= $waktuMulai));
            return $item;
        });

        $pengumpulan_tugass = pengumpulan_tugas::where('id_kelompok_pjbl', $idkelompok_pjbl)->get()->keyBy('id_aktivitas_pjbl');

        $anggota_kelompok = anggota_kelompok::with('user', 'posisi') // tambah relasi 'posisi'
            ->where('id_kelompok_pjbl', $idkelompok_pjbl)
            ->get();

        return view('siswa/aktivitas_pjbl/aktivitas_pjbl', [
            'tittle' => 'Project Based Learning',
            'aktivitas_pjbls' => $aktivitas_pjbls,
            'anggota_kelompok' => $anggota_kelompok,
            'pengumpulan_tugass' => $pengumpulan_tugass,
            'mapel' => $mapel,
            'siklus_pjbl' => $siklus_pjbl,
        ]);
    }



    //syntax siswa
    public function syntax(string $mapel_slug, string $siklus_pjbl_slug, string $aktivitas_pjbl_slug)
    {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $siklus_pjbl = \App\Models\siklus_pjbl::where('slug', $siklus_pjbl_slug)->firstOrFail();
        $aktivitas_pjbl = \App\Models\aktivitas_pjbl::where('slug', $aktivitas_pjbl_slug)->firstOrFail();
        $userId = Auth::id();

        $userkelompok_pjbl = anggota_kelompok::with('posisi')
            ->where('id_user', $userId)
            ->first();

        if (!$userkelompok_pjbl) {
            return redirect()->back()->with('error', 'Kamu belum tergabung dalam kelompok_pjbl manapun.');
        }

        $idkelompok_pjbl = $userkelompok_pjbl->id_kelompok_pjbl;
        $namaPosisi = $userkelompok_pjbl->posisi->nama_posisi ?? 'anggota';

        $studi_kasus = studi_kasus::where('id_kelompok_pjbl', $idkelompok_pjbl)->get();

        $canCreateTugas = strtolower($namaPosisi) === 'ketua';

        $anggotakelompok_pjbl = anggota_kelompok::with(['user', 'posisi'])
            ->where('id_kelompok_pjbl', $idkelompok_pjbl)
            ->get();

        // Ambil semua tugas yang terkait dengan aktivitas_pjbl dan anggota kelompok_pjbl ini
        $idAnggotakelompok_pjbl = $anggotakelompok_pjbl->pluck('id')->toArray();

        if (strtolower($namaPosisi) === 'ketua') {
            // Ketua melihat semua tugas kelompok_pjbl
            $idAnggotakelompok_pjbl = $anggotakelompok_pjbl->pluck('id')->toArray();

            $tugas = tugas::where('id_aktivitas_pjbl', $aktivitas_pjbl->id)
                ->whereIn('id_anggota_kelompok', $idAnggotakelompok_pjbl)
                ->get();
        } else {
            // Anggota biasa hanya melihat tugas miliknya
            $tugas = tugas::where('id_aktivitas_pjbl', $aktivitas_pjbl->id)
                ->where('id_anggota_kelompok', $userkelompok_pjbl->id)
                ->get();
        }

        if (!$siklus_pjbl || !$siklus_pjbl->id) {
            return redirect()->back()->with('error', 'siklus_pjbl tidak ditemukan.');
        }

        // dd($tugas);
        return view('siswa/aktivitas_pjbl/syntax', [
            'tittle' => 'Project Based Learning',
            'mapel' => $mapel,
            'aktivitas_pjbl' => $aktivitas_pjbl,
            'studi_kasus' => $studi_kasus,
            'siklus_pjbl' => $siklus_pjbl,
            'kelompok_pjblUser' => $userkelompok_pjbl,
            'canCreateTugas' => $canCreateTugas,
            'anggotakelompok_pjbl' => $anggotakelompok_pjbl,
            'tugas' => $tugas, // kirim data tugas ke view
        ]);
    }

    public function update_studi_kasus(Request $request, $id)
    {
        $request->validate([
            'studi_kasus' => 'required|string',
        ]);

        $sk = studi_kasus::findOrFail($id);
        $sk->studi_kasus = $request->studi_kasus;
        $sk->save();

        return redirect()->back()->with('success', 'Studi Kasus berhasil diperbarui.');
    }

    public function destroy_studi_kasus($id)
    {
        $sk = studi_kasus::findOrFail($id);
        $sk->delete();

        return redirect()->back()->with('success', 'Studi Kasus berhasil dihapus.');
    }


    //pembacaan aktivitas_pjbl
    public function guru_syntax(string $mapel_slug, string $kelompok_id)
    {
        // 2. Cari secara manual
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        $kelompok_pjbl = \App\Models\kelompok_pjbl::findOrFail($kelompok_id);

        // 3. Cek apakah ini berhasil
        // dd($mapel, $kelompok_pjbl);

        $aktivitas_pjbls = aktivitas_pjbl::where('id_mapel', $mapel->id)
            ->orderBy('urutan')
            ->get()
            ->transform(function ($a) {
                $a->pengumpulan_tugas = intval($a->pengumpulan_tugas);
                return $a;
            });

        $anggotakelompok_pjbl = anggota_kelompok::with(['user', 'posisi'])
            ->where('id_kelompok_pjbl', $kelompok_pjbl->id)
            ->get();

        $tugas_by_aktivitas = Tugas::with(['anggotaKelompok.user', 'anggotaKelompok.posisi'])
            ->whereIn('id_anggota_kelompok', $anggotakelompok_pjbl->pluck('id'))
            ->whereIn('id_aktivitas_pjbl', $aktivitas_pjbls->pluck('id'))
            ->get()
            ->groupBy('id_aktivitas_pjbl');

        $diskusi = \App\Models\Diskusi::where('id_kelompok_pjbl', $kelompok_pjbl->id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('id_aktivitas_pjbl');

        // 🔥 Pengaturan aktivitas 3/4/5
        $jenis_share = [3, 4, 5];
        $aktivitas_share = $aktivitas_pjbls->whereIn('pengumpulan_tugas', $jenis_share);
        $sumber = null;

        foreach ($aktivitas_share as $a) {
            if (isset($tugas_by_aktivitas[$a->id]) && $tugas_by_aktivitas[$a->id]->isNotEmpty()) {
                $sumber = $a->id;
                break;
            }
        }

        if ($sumber) {
            foreach ($aktivitas_share as $a) {
                $tugas_by_aktivitas[$a->id] = $tugas_by_aktivitas[$sumber];
            }
        }

        $pengumpulan_tugass = pengumpulan_tugas::where('id_kelompok_pjbl', $kelompok_pjbl->id)
            ->get()
            ->keyBy('id_aktivitas_pjbl');
        // dd([
        //         'mapel' => $mapel,
        //         'kelompok_pjbl' => $kelompok_pjbl,
        //         'aktivitas_pjbls_count' => $aktivitas_pjbls->count(),
        //         'anggotakelompok_pjbl_count' => $anggotakelompok_pjbl->count(),
        //         'pengumpulan_tugass' => $pengumpulan_tugass,
        //             'tugas_by_aktivitas' => $tugas_by_aktivitas,
        //             'diskusi' => $diskusi
        //     ]);
        return view('guru.kelompok.detail', compact(
            'mapel',
            'kelompok_pjbl',
            'aktivitas_pjbls',
            'anggotakelompok_pjbl',
            'pengumpulan_tugass',
            'tugas_by_aktivitas',
            'diskusi'
        ));
    }


    //validasi aktivitas_pjbl
    public function validasipengumpulan_tugas(Request $request, $id)
    {
        $pengumpulan = Pengumpulan_Tugas::findOrFail($id);

        // Ambil aktivitas terkait
        $aktivitas = aktivitas_pjbl::find($pengumpulan->id_aktivitas_pjbl);

        // ================================
        // Tambahkan id_siklus_pjbl dari aktivitas
        // ================================
        $pengumpulan->id_siklus_pjbl = $aktivitas->id_siklus_pjbl;
        // ================================

        // Hitung jumlah chat diskusi
        $jumlahChat = diskusi::where('id_kelompok_pjbl', $pengumpulan->id_kelompok_pjbl)
            ->where('id_aktivitas_pjbl', $pengumpulan->id_aktivitas_pjbl)
            ->count();

        // Hitung nilai otomatis
        $penalty = $jumlahChat * 4; // penalty per chat
        $nilai = max(0, $aktivitas->nilai_maks - $penalty);

        // Simpan
        $pengumpulan->status = 2; // divalidasi
        $pengumpulan->nilai = $nilai;
        $pengumpulan->save();

        return back()->with('success', 'Tugas berhasil divalidasi');
    }




    // store syntax
    public function store_syntax(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'id_siklus_pjbl' => 'required',
            'id_pertemuan' => 'required',
            'urutan' => 'required',
            'nama_syntax' => 'required',
            'slug' => 'required',
            'pengumpulan_tugas' => 'nullable',
            'penjelasan' => 'required', // kelas boleh kosong
            'waktu_mulai' => 'required',
            'waktu' => 'required',
        ]);
        // dd($validatedData);
        aktivitas_pjbl::create($validatedData);

        return redirect()->back()->with('success', 'Registrasi Berhasil, Silakan Login');
    }

    public function update_syntax(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'id' => 'required|exists:aktivitas_pjbls,id',
            'urutan' => 'required|integer',
            'id_mapel' => 'required|integer',
            'id_siklus_pjbl' => 'required|exists:aktivitas_pjbls,id',
            'id_pertemuan' => 'required',
            'nama_syntax' => 'required|string',
            'slug' => 'required|string',
            'penjelasan' => 'required|string',
            'waktu' => 'required|string',
            'waktu_mulai' => 'required|date',
            'pengumpulan_tugas' => 'nullable|integer',
        ]);

        $syntax = aktivitas_pjbl::findOrFail($request->id);
        $syntax->update($validated);

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy_syntax(Request $request)
    {
        // dd($request);
        $request->validate([
            'id' => 'required'
        ]);

        aktivitas_pjbl::destroy($request->id);

        return back()->with('success', 'Data berhasil dihapus.');
    }



    //menmbah studi_kasus
    public function studi_kasus()
    {
        $mapel =  Mapel::first();
        $studi_kasus = studi_kasus::where('id_mapel', $mapel->id)->get();
        $kelompok_pjbl = kelompok_pjbl::where('id_mapel', $mapel->id)->get();

        return view('guru/aktivitas_pjbl/index', [
            'tittle' => 'Studi Kasus Project Based Learning',
            'studi_kasus' => $studi_kasus,
            'mapel' => $mapel,
            'kelompok_pjbl' => $kelompok_pjbl,
        ]);
    }
    //store studi_kasus
    public function store_studi_kasus(Request $request)
    {
        $validatedData = $request->validate([
            'id_mapel' => 'required',
            'id_kelompok_pjbl' => 'required',
            'studi_kasus' => 'required',
        ]);
        // dd($validatedData);
        studi_kasus::create($validatedData);

        return redirect()->back()->with('success', 'Registrasi Berhasil, Silakan Login');
    }

    public function diskusi()
    {
        return view('guru/aktivitas_pjbl/diskusi', ['tittle' => 'Diskusi']);
    }

    //siswa pengumpulan_tugas
    public function pengumpulan_tugas_siswa_syntax(Request $request)
    {
        // dd($request);
        Log::info('Form submit diterima', $request->all());

        $aktivitas_pjbl = aktivitas_pjbl::findOrFail($request->id_aktivitas_pjbl);
        $mapel = $aktivitas_pjbl->Mapel; // Pastikan kamu sudah punya relasi 'mapel()' di model aktivitas_pjbl


        $validatedData = $request->validate([
            'id_kelompok_pjbl' => 'required',
            'id_siklus_pjbl' => 'required',
            'file_pengumpulan_tugas' => 'nullable|file',
            'id_aktivitas_pjbl' => 'required',
            'id_user' => 'required',
            'id_siklus_pjbl' => 'required',
            'deskriptif' => 'nullable|string',
        ]);

        $validatedData['status'] = 1;

        // Handle upload file jika ada
        if ($request->hasFile('file_pengumpulan_tugas')) {
            $file = $request->file('file_pengumpulan_tugas');
            $path = $file->store('pengumpulan_tugas_files', 'public');
            $validatedData['file_pengumpulan_tugas'] = $path;
        }

        $alreadySubmitted = pengumpulan_tugas::where('id_kelompok_pjbl', $request->id_kelompok_pjbl)
            ->where('id_aktivitas_pjbl', $request->id_aktivitas_pjbl)
            ->exists();

        if ($alreadySubmitted) {
            return back()->with('error', 'kelompok_pjblmu sudah mengumpulkan tahap ini.');
        }

        pengumpulan_tugas::create($validatedData);

        return back()->with('success', 'Jawaban berhasil dikumpulkan!');
    }
}
