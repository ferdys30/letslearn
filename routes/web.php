<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\PjblController;
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

Route::get('/siswa/materi', [MateriController::class, 'siswa']);

Route::get('/siswa/kuis', [KuisController::class, 'siswa'])->middleware('auth');

Route::get('/siswa/pjbl/kelompok', [KelompokController::class, 'kelompok'] )->middleware('auth');

Route::get('/siswa/pjbl/{pjbl:slug}', [PjblController::class, 'syntax'])->middleware('auth');


Route::get('/guru', [HomeController::class,'guru'])->middleware('auth');

// Route::get('/guru/kelas', function () {
//     return view('guru/kelas/fitur');
// });

Route::get('/guru/materi',[MateriController::class, 'guru'])->middleware('auth');

Route::get('/guru/kuis', [KuisController::class,'kuis'])->middleware('auth');

Route::get('/guru/kuis/{kuis:slug}', [KuisController::class,'soal'])->middleware('auth');

Route::get('/guru/mapel', [MataPelajaranController::class, 'mapel'])->middleware('auth');
Route::post('/store/tp', [MataPelajaranController::class, 'store_tp']);
Route::post('/store/indikator', [MataPelajaranController::class, 'store_indikator']);

//halaman menambah syntax
Route::get('/guru/syntax', [PjblController::class,'syntax_guru'])->middleware('auth');
Route::post('/tambah/syntax', [PjblController::class,'store_syntax']);

//halaman kelompok
Route::get('/guru/pjbl/kelompok',[KelompokController::class,'guru'])->middleware('auth');

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
