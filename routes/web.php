<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ['tittle' => 'Dashboard']);
});

Route::get('/login', function () {
    return view('auth/login', ['tittle' => 'Login']);
});

Route::get('/regist', function () {
    return view('auth/regist', ['tittle' => 'Regist']);
});

Route::get('/siswa/kelas', function () {
    return view('siswa/kelas/fitur', ['tittle' => 'Kelas'] );
});

Route::get('/siswa/materi', function () {
    return view('siswa/materi/index', ['tittle' => 'Materi']);
});

Route::get('/siswa/kuis', function () {
    return view('siswa/kuis/index', ['tittle' => 'Kuis']);
});

Route::get('/siswa/pjbl/kelompok', function () {
    return view('siswa/pjbl/kelompok', ['tittle' => 'Project Based Learning']);
});

Route::get('/siswa/pjbl', function () {
    return view('siswa/pjbl/index', ['tittle' => 'Project Based Learning']);
});

Route::get('/guru', function () {
    return view('guru/index', ['tittle' => 'Dashboard']);
});

// Route::get('/guru/kelas', function () {
//     return view('guru/kelas/fitur');
// });

Route::get('/guru/materi', function () {
    return view('guru/materi/index', ['tittle' => 'Materi']);
});

Route::get('/guru/kuis', function () {
    return view('guru/kuis/index', ['tittle' => 'Kuis']);
});

Route::get('/guru/kuis/1', function () {
    return view('guru/kuis/soal', ['tittle' => 'Tambahkan Soal']);
});

Route::get('/guru/mapel', function () {
    return view('guru/mapel/index', ['tittle' => 'Kelompok']);
});

Route::get('/guru/syntax', function () {
    return view('guru/pjbl/syntax', ['tittle' => 'Syntax Project Based Learning']);
});

Route::get('/guru/pjbl/kelompok', function () {
    return view('guru/pjbl/kelompok', ['tittle' => 'Kelompok']);
});

Route::get('/guru/pjbl/studi_kasus', function () {
    return view('guru/pjbl/index', ['tittle' => 'Studi Kasus Project Based Learning']);
});

Route::get('/guru/pjbl/diskusi', function(){ //kurang ini siswa dlu
    return view('guru/pjbl/diskusi', ['tittle' => 'Diskusi']);
});

Route::get('/guru/penilaian', function () {
    return view('guru/penilaian/index', ['tittle' => 'Penilaian']);
});

Route::get('/guru/penilaian/siswa', function () {
    return view('guru/penilaian/siswa', ['tittle' => 'Penilaian Siswa']);
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
