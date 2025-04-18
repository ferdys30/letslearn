<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ['tittle' => 'Dashboard']);
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/regist', function () {
    return view('auth/regist');
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

    return view('siswa/pj\hgbl/index', ['tittle' => 'Project Based Learning']);
Route::get('/siswa/pjbl', function () {
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

Route::get('/guru/pjbl', function () {
    return view('guru/pjbl/index', ['tittle' => 'Project Based Learning']);
});

Route::get('/guru/kelompok', function () {
    return view('guru/pjbl/kelompok', ['tittle' => 'Kelompok']);
});

Route::get('/guru/diskusi', function () {
    return view('guru/pjbl/diskusi', ['tittle' => 'Diskusi']);
});

Route::get('/guru/penilaian', function () {
    return view('guru/penilaian/index', ['tittle' => 'Penilaian']);
});

Route::get('/guru/penilaian/siswa', function () {
    return view('guru/penilaian/siswa', ['tittle' => 'Penilaian Siswa']);
});