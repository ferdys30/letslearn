<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\PjblController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\MataPelajaranController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class,'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class,'auth']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/regist', [AuthController::class,'regist'])->middleware('guest');
Route::post('/regist', [AuthController::class,'store']);

// Route::get('/siswa/kelas', function () {
//     return view('siswa/kelas/fitur', ['tittle' => 'Kelas'] );
// });

Route::get('/siswa/kelas/fitur/{mapel:id}', [KelasController::class, 'fitur'])->middleware('auth');

Route::get('/siswa/materi', [MateriController::class, 'siswa']);

Route::get('/siswa/kuis', [KuisController::class, 'index'])->name('siswa.kuis.index');
Route::get('/siswa/kuis/{kuis}', [KuisController::class, 'show'])->name('siswa.kuis.show');
Route::post('/siswa/kuis/{kuis}/submit', [KuisController::class, 'submit'])->name('siswa.kuis.submit');

// GET semua kuis untuk mapel tertentu
// Route::get('/siswa/kuis/{id_mapel}', [KuisController::class, 'siswa'])->name('siswa.kuis');


Route::get('/siswa/pjbl/kelompok', [KelompokController::class, 'kelompok'] )->middleware('auth');
Route::post('/store/kelompok', [KelompokController::class, 'store_kelompok']);
Route::post('/gabung/kelompok', [KelompokController::class, 'gabung_kelompok']);

Route::get('/siswa/pjbl', [PjblController::class, 'index']);
Route::get('/siswa/pjbl/{pjbl:slug}', [PjblController::class, 'syntax']);
Route::post('/pengumpulan/syntax', [PjblController::class, 'pengumpulan_siswa_syntax'])->name('pengumpulan.syntax');


Route::get('/guru', [HomeController::class,'guru'])->middleware('auth');

Route::get('/guru/materi', [MateriController::class, 'guru'])->middleware('auth');
Route::post('/guru/materi', [MateriController::class, 'store'])->middleware('auth'); // 👉 Route untuk menyimpan data
// Route::get('/guru/materi/{id_mapel}', [MateriController::class, 'byMapel'])->middleware('auth'); // 👉 Route untuk data berdasarkan mapel

// Menampilkan daftar kuis
Route::get('/guru/kuis', [KuisController::class, 'kuis'])->middleware('auth');
Route::post('/guru/kuis', [KuisController::class, 'store'])->middleware('auth');

Route::get('/guru/kuis/{kuis}/soal', [KuisController::class, 'soal'])->name('kuis.soal')->middleware('auth');
Route::post('/guru/kuis/{kuis:id}/soal', [KuisController::class, 'store_soal'])->middleware('auth');

Route::get('/guru/mapel', [MataPelajaranController::class, 'mapel'])->middleware('auth');
Route::post('/store/tp', [MataPelajaranController::class, 'store_tp']);
Route::post('/store/indikator', [MataPelajaranController::class, 'store_indikator']);

//halaman menambah syntax
Route::get('/guru/syntax', [PjblController::class,'syntax_guru'])->middleware('auth');
Route::post('/tambah/syntax', [PjblController::class,'store_syntax']);

//halaman kelompok
Route::get('/guru/pjbl/kelompok',[KelompokController::class,'guru'])->middleware('auth');
Route::get('/guru/pjbl/kelompok/{kelompok:nama}',[PjblController::class,'guru_syntax'])->middleware('auth');
Route::put('/guru/pjbl/validasi/{id}', [PjblController::class, 'validasiPengumpulan'])
    ->name('guru.pjbl.validasi');

Route::get('/guru/pjbl/studi_kasus', [PjblController::class,'studi_kasus'])->middleware('auth');
Route::post('/tambah/studi_kasus', [PjblController::class,'store_studi_kasus']);

Route::get('/guru/pjbl/diskusi', [PjblController::class, 'diskusi'])->middleware('auth');

Route::get('/guru/penilaian', [PenilaianController::class,'index'])->middleware('auth');

Route::get('/guru/penilaian/{user:nama}', [PenilaianController::class,'siswa'])->middleware('auth');

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
