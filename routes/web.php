<?php

use App\Models\Penilaian;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SiklusPjblController;
use App\Http\Controllers\kelompok_pjblController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\aktivitas_pjblController;
use App\Http\Controllers\pengumpulan_tugasController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('locale/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('login.proses');
    Route::get('/regist', [AuthController::class, 'regist'])->name('register');
    Route::post('/regist', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Authenticated
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


    Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->name('siswa.')->group(function () {
        // Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/{mapel:slug}/fitur', [KelasController::class, 'fitur'])->name('kelas.fitur');

        // Materi
        Route::get('/kelas/{mapel:slug}/materi', [MateriController::class, 'siswa'])->name('kelas.materi');

        // Kuis
        Route::get('/kelas/{mapel:slug}/kuis', [KuisController::class, 'index'])->name('kelas.kuis');
        Route::get('/kelas/{mapel:slug}/kuis/{kuis}', [KuisController::class, 'show'])->name('kelas.kuis.show');
        Route::post('/kuis/{kuis}/submit', [KuisController::class, 'submit'])->name('kelas.kuis.submit');

        // aktivitas_pjbl (Project Based Learning)
        Route::get('/kelas/{mapel:slug}/siklus_pjbl', [aktivitas_pjblController::class, 'index'])->name('kelas.siklus_pjbl');

        Route::get('/kelas/{mapel:slug}/{siklus_pjbl:slug}/kelompok_pjbl', [kelompok_pjblController::class, 'kelompok_pjbl'])->name('kelas.aktivitas_pjbl.kelompok_pjbl');
        Route::post('/kelompok_pjbl/store', [kelompok_pjblController::class, 'store_kelompok_pjbl'])->name('kelas.aktivitas_pjbl.kelompok_pjbl.store');
        Route::post('/kelompok_pjbl/gabung', [kelompok_pjblController::class, 'gabung_kelompok_pjbl'])->name('kelas.aktivitas_pjbl.kelompok_pjbl.gabung');

        Route::get('/kelas/{mapel:slug}/siklus_pjbl/{siklus_pjbl:slug}', [aktivitas_pjblController::class, 'aktivitas_pjbl'])->name('kelas.siklus_pjbl.show');
        Route::get('/kelas/{mapel:slug}/{siklus_pjbl:slug}/{aktivitas_pjbl:slug}', [aktivitas_pjblController::class, 'syntax'])->name('kelas.aktivitas_pjbl.syntax');

        Route::post('/aktivitas_pjbl/pengumpulan_tugas', [aktivitas_pjblController::class, 'pengumpulan_tugas_siswa_syntax'])->name('kelas.aktivitas_pjbl.pengumpulan_tugas');
        Route::post('/tugas', [pengumpulan_tugasController::class, 'store'])->name('tugas.store');
    });

    // =======================
    // Guru Routes
    // =======================
    Route::prefix('guru')->middleware(['auth', 'role:guru'])->name('guru.')->group(function () {
        Route::get('/', [HomeController::class, 'guru'])->name('dashboard');

        // Mapel
        Route::get('/mapel/{slug}', [MataPelajaranController::class, 'index'])->name('mapel');

        //rekap
        Route::get('/{slug}/rekap', [RekapController::class, 'index'])->name('rekap');
        Route::get('/{slug}/rekap/siswa/{idSiswa}/siklus/{idSiklus}', [RekapController::class, 'detailSiklus'])
            ->name('rekap.detail.siklus');

        // Detail Mata Pelajaran
        Route::get('/mapel/{mapel:slug}/detail', [MataPelajaranController::class, 'detail'])->name('mapel.detail');
        Route::put('/mapel/{mapel}', [MataPelajaranController::class, 'update_deskripsi'])->name('mapel.update');
        Route::post('/store/tp', [MataPelajaranController::class, 'store_tp'])->name('tp.store');
        Route::put('/tp/update/{id}', [MataPelajaranController::class, 'update_tp'])->name('tp.update');

        //Pertemuan
        Route::get('/{mapel:slug}/pertemuan', [MataPelajaranController::class, 'pertemuan'])->name('pertemuan');
        Route::post('/store/pertemuan', [MataPelajaranController::class, 'store_pertemuan'])->name('pertemuan.store');
        Route::put('/update/pertemuan/{id}', [MataPelajaranController::class, 'update_pertemuan'])->name('pertemuan.update');
        Route::delete('/destroy/pertemuan/{id}', [MataPelajaranController::class, 'destroy_pertemuan'])->name('pertemuan.destroy');

        // Materi
        Route::get('/{mapel:slug}/materi', [MateriController::class, 'guru'])->name('materi');
        Route::post('/store/materi', [MateriController::class, 'store_materi'])->name('materi.store');
        Route::put('/update/materi/{id}', [MateriController::class, 'update_materi'])->name('materi.update');
        Route::delete('/destroy/materi/{id}', [MateriController::class, 'destroy_materi'])->name('materi.destroy');

        // Kuis
        Route::get('{mapel:slug}/kuis', [KuisController::class, 'kuis'])->name('kuis');
        Route::post('/kuis', [KuisController::class, 'store_kuis'])->name('kuis.store');
        Route::put('/update/kuis/{id}', [KuisController::class, 'update_kuis'])->name('kuis.update');

        //Soal
        Route::get('{mapel:slug}/kuis/{kuis}/soal', [KuisController::class, 'soal'])->name('soal');
        Route::post('/store/soal', [KuisController::class, 'store_soal'])->name('soal.store');
        Route::put('/update/soal/{id}', [KuisController::class, 'update_soal'])->name('soal.update');
        Route::delete('/delete/soal/{id}', [KuisController::class, 'delete_soal'])->name('soal.delete');

        //Rekap Nilai
        Route::get('{mapel:slug}/rekap', [RekapController::class, 'rekap'])->name('rekap');

        // siklus_pjbl
        Route::get('/{mapel:slug}/{siklus_pjbl:slug}', [SiklusPjblController::class, 'index'])->name('siklus');
        Route::post('/siklus-pjbls', [SiklusPjblController::class, 'store'])->name('siklus_pjbls.store');

        //posisi
        Route::get('/{mapel:slug}/{siklus_pjbl:slug}/posisi', [PosisiController::class, 'posisi'])->name('posisi');
        Route::post('/store/posisi', [PosisiController::class, 'store_posisi'])->name('posisi.store');
        // Route::put('/posisi/update/{id}', [PosisiController::class, 'update_posisi'])->name('posisi.update');
        Route::delete('/posisi/delete/{id}', [PosisiController::class, 'destroy_posisi'])->name('posisi.delete');

        //indikator
        Route::get('/{mapel:slug}/{siklus_pjbl:slug}/indikator', [SiklusPjblController::class, 'indikator'])->name('indikator');
        Route::post('/store/indikator', [MataPelajaranController::class, 'store_indikator'])->name('indikator.store');
        Route::put('/indikator/update/{id}', [MataPelajaranController::class, 'update_indikator'])->name('indikator.update');
        Route::delete('/indikator/delete/{id}', [MataPelajaranController::class, 'destroy_indikator'])->name('indikator.delete');

        //aktivitas_pjbl
        Route::get('/{mapel:slug}/{siklus_pjbl:slug}/aktivitas_pjbl', [SiklusPjblController::class, 'aktivitas_pjbl'])->name('aktivitas_pjbl');
        Route::post('/tambah/syntax', [aktivitas_pjblController::class, 'store_syntax'])->name('aktivitas_pjbl.store');
        Route::put('/edit/syntax/{id}', [aktivitas_pjblController::class, 'update_syntax'])->name('aktivitas_pjbl.update');
        Route::delete('/delete/syntax/{id}', [aktivitas_pjblController::class, 'destroy_syntax'])->name('aktivitas_pjbl.destroy');

        //studi Kasus
        Route::get('/{mapel:slug}/{siklus_pjbl:slug}/studi_kasus', [SiklusPjblController::class, 'studi_kasus'])->name('studi_kasus');
        Route::post('/tambah/studi_kasus', [aktivitas_pjblController::class, 'store_studi_kasus'])->name('studi_kasus.store');
        Route::put('/edit/studi_kasus/{id}', [aktivitas_pjblController::class, 'update_studi_kasus'])->name('studi_kasus.update');
        Route::delete('/delete/studi_kasus/{id}', [aktivitas_pjblController::class, 'destroy_studi_kasus'])->name('studi_kasus.destroy');

        // Validasi Guru
        // Route::get('{mapel:slug}/aktivitas_pjbl/kelompok_pjbl', [kelompok_pjblController::class, 'guru'])->name('aktivitas_pjbl.kelompok_pjbl'); // masukkan ke dalam mapel> aktivitas
        Route::get('{mapel_slug}/aktivitas_pjbl/kelompok_pjbl/{kelompok_id}', [aktivitas_pjblController::class, 'guru_syntax'])->name('aktivitas_pjbl.kelompok_pjbl.detail');
        Route::put('/aktivitas_pjbl/validasi/{id}', [aktivitas_pjblController::class, 'validasipengumpulan_tugas'])->name('aktivitas_pjbl.validasi');
        Route::put('/aktivitas_pjbl/revisi/{id}', [DiskusiController::class, 'revisi'])
            ->name('aktivitas_pjbl.revisi');

        // Penilaian
        Route::get('/{mapel_slug}/{siklus_slug}/{kelompok_id}', [PenilaianController::class, 'index'])->name('penilaian');
        // Route::get('/{mapel:slug}/{siklus_pjbl:slug}/{kelompok:id}', [PenilaianController::class, 'index'])->name('penilaian');
        // Route::get('/{mapel:slug}/{siklus_pjbl:slug}/{kelompok}', [PenilaianController::class, 'index'])->name('penilaian');
        Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
        Route::get('{mapel:slug}/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('{mapel:slug}/penilaian/{user:nama}', [PenilaianController::class, 'siswa'])->name('penilaian.siswa');
    });

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/guru', [AdminController::class, 'guru'])->name('guru');
        Route::put('/edit/guru/{id}', [AdminController::class, 'update_guru'])->name('guru.update');
        Route::post('/guru/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('resetPassword');


        Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa');
        Route::put('/edit/siswa/{id}', [AdminController::class, 'update_siswa'])->name('siswa.update');
        Route::post('/siswa/{id}/reset-password', [AdminController::class, 'resetPassword_siswa'])->name('siswa.resetPassword');

        Route::get('/mapel', [AdminController::class, 'mapel'])->name('mapel');
        Route::post('/store/mapel', [AdminController::class, 'store_mapel'])->name('mapel.store');
        Route::put('/update/mapel/{id}', [AdminController::class, 'update_mapel'])->name('mapel.update');
        Route::delete('/destroy/mapel/{id}', [AdminController::class, 'destroy_mapel'])->name('mapel.destroy');

        Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas');
        Route::post('/store/kelas', [AdminController::class, 'store_kelas'])->name('kelas.store');
        Route::delete('/destroy/kelas/{id}', [AdminController::class, 'destroy_kelas'])->name('kelas.destroy');

        Route::get('/kelas/{kelas:id}', [AdminController::class, 'paralel_kelas'])->name('paralel.kelas');
        Route::get('/kelas/{kelas}/naikkan', [AdminController::class, 'pilihNaikKelas'])->name('kelas.naikkan');
        Route::post('/kelas/naikkan', [AdminController::class, 'prosesNaikKelas'])->name('kelas.prosesNaik');
    });
});

// //nnti di delete
// Route::get('/siswa/aktivitas_pjbl/1_2', function () {
//     return view('siswa/aktivitas_pjbl/1_2', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/1_3', function () {
//     return view('siswa/aktivitas_pjbl/1_3', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/2', function () {
//     return view('siswa/aktivitas_pjbl/2', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/3', function () {
//     return view('siswa/aktivitas_pjbl/3', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/4', function () {
//     return view('siswa/aktivitas_pjbl/4', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/5', function () {
//     return view('siswa/aktivitas_pjbl/5', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/6', function () {
//     return view('siswa/aktivitas_pjbl/6', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/7', function () {
//     return view('siswa/aktivitas_pjbl/7', ['tittle' => 'Project Based Learning']);
// });
// Route::get('/siswa/aktivitas_pjbl/8', function () {
//     return view('siswa/aktivitas_pjbl/8', ['tittle' => 'Project Based Learning']);
// });
