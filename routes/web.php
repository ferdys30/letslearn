<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\PjblController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\MataPelajaranController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'auth']);
    Route::get('/regist', [AuthController::class,'regist'])->name('register');
    Route::post('/regist', [AuthController::class,'store']);
});

Route::middleware('auth')->group(function () {
    // Authenticated
    Route::post('/logout', [AuthController::class,'logout'])->middleware('auth')->name('logout');


    Route::prefix('siswa')->middleware('auth')->name('siswa.')->group(function () {
        // Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/{mapel:slug}/fitur', [KelasController::class, 'fitur'])->name('kelas.fitur');
        
        // Materi
        Route::get('/kelas/{mapel:slug}/materi', [MateriController::class, 'siswa'])->name('kelas.materi');
        
        // Kuis
        Route::get('/kelas/{mapel:slug}/kuis', [KuisController::class, 'index'])->name('kelas.kuis');
        Route::get('/kelas/{mapel:slug}/kuis/{kuis}', [KuisController::class, 'show'])->name('kelas.kuis.show');
        Route::post('/kuis/{kuis}/submit', [KuisController::class, 'submit'])->name('kelas.kuis.submit');
        
        // PJBL (Project Based Learning)
        Route::get('/kelas/{mapel:slug}/penugasan', [PjblController::class, 'index'])->name('kelas.penugasan');

        Route::get('/kelas/{mapel:slug}/penugasan/{penugasan:slug}/kelompok', [KelompokController::class, 'kelompok'])->name('kelas.pjbl.kelompok');
        Route::post('/kelompok/store', [KelompokController::class, 'store_kelompok'])->name('kelas.pjbl.kelompok.store');
        Route::post('/kelompok/gabung', [KelompokController::class, 'gabung_kelompok'])->name('kelas.pjbl.kelompok.gabung');
        
        Route::get('/kelas/{mapel:slug}/penugasan/{penugasan:slug}', [PjblController::class, 'pjbl'])->name('kelas.penugasan.show');
        Route::get('/kelas/{mapel:slug}/{penugasan:slug}/{pjbl:slug}', [PjblController::class, 'syntax'])->name('kelas.pjbl.syntax');
        Route::post('/pjbl/pengumpulan', [PjblController::class, 'pengumpulan_siswa_syntax'])->name('kelas.pjbl.pengumpulan');
        Route::post('/tugas', [PengumpulanController::class, 'store'])->name('tugas.store');
    });

    // =======================
    // Guru Routes
    // =======================
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/', [HomeController::class, 'guru'])->name('dashboard');
        
        // Mapel
        Route::get('/mapel/{mapel:slug}', [MataPelajaranController::class, 'index'])->name('mapel');
        Route::get('/mapel/{mapel:slug}/detail', [MataPelajaranController::class, 'detail'])->name('mapel.detail');
        Route::post('/store/tp', [MataPelajaranController::class, 'store_tp'])->name('tp.store');
        Route::post('/store/indikator', [MataPelajaranController::class, 'store_indikator'])->name('indikator.store');
        
        // Materi
        Route::get('/{mapel:slug}/materi', [MateriController::class, 'guru'])->name('materi');
        Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');

        // Kuis
        Route::get('{mapel:slug}/kuis', [KuisController::class, 'kuis'])->name('kuis');
        Route::post('/kuis', [KuisController::class, 'store'])->name('kuis.store');
        Route::get('{mapel:slug}/kuis/{kuis}/soal', [KuisController::class, 'soal'])->name('kuis.soal');
        Route::post('/kuis/soal', [KuisController::class, 'store_soal'])->name('kuis.soal.store');

        // PJBL
        Route::get('{mapel:slug}/pjbl/kelompok', [KelompokController::class, 'guru'])->name('pjbl.kelompok');
        Route::get('{mapel:slug}/pjbl/kelompok/{kelompok:nama}', [PjblController::class, 'guru_syntax'])->name('pjbl.kelompok.detail');
        Route::put('/pjbl/validasi/{id}', [PjblController::class, 'validasiPengumpulan'])->name('pjbl.validasi');
        Route::get('{mapel:slug}/pjbl/studi_kasus', [PjblController::class, 'studi_kasus'])->name('pjbl.studi_kasus');
        Route::post('/tambah/studi_kasus', [PjblController::class, 'store_studi_kasus'])->name('pjbl.studi_kasus.store');
        Route::get('{mapel:slug}/pjbl/diskusi', [PjblController::class, 'diskusi'])->name('pjbl.diskusi');
        Route::get('{mapel:slug}/syntax', [PjblController::class, 'syntax_guru'])->name('pjbl.syntax');
        Route::post('/tambah/syntax', [PjblController::class, 'store_syntax'])->name('syntax.store');

        // Penilaian
        Route::get('{mapel:slug}/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('{mapel:slug}/penilaian/{user:nama}', [PenilaianController::class, 'siswa'])->name('penilaian.siswa');
    });
});

//nnti di delete
Route::get('/siswa/pjbl/1_2', function () {
    return view('siswa/pjbl/1_2', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/1_3', function () {
    return view('siswa/pjbl/1_3', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/2', function () {
    return view('siswa/pjbl/2', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/3', function () {
    return view('siswa/pjbl/3', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/4', function () {
    return view('siswa/pjbl/4', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/5', function () {
    return view('siswa/pjbl/5', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/6', function () {
    return view('siswa/pjbl/6', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/7', function () {
    return view('siswa/pjbl/7', ['tittle' => 'Project Based Learning']);
});
Route::get('/siswa/pjbl/8', function () {
    return view('siswa/pjbl/8', ['tittle' => 'Project Based Learning']);
});
