<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function login(){
    return view('auth/login', ['tittle' => 'Login']);
}

public function regist(){
    $kelas = Kelas::all(); // Ambil semua data kelas
    return view('auth/regist', ['tittle' => 'Regist','kelas'=> $kelas]);
}

public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

public function auth(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        // Arahkan ke halaman berbeda berdasarkan apakah user memiliki 'nip'
        if ($user->id_role == 2) {
            Log::info('Redirect ke guru');
            return redirect()->intended('/guru');
        } elseif ($user->id_role == 3) {
            Log::info('Redirect ke beranda');
            return redirect()->intended('/');
        } else {
            Log::info('Redirect default ke guru');
            return redirect()->intended('/guru');
        }

    }

    return back()->with('LoginError', 'Gagal Login!');
}



public function store(Request $request)
{
    // dd($request);
    $validatedData = $request->validate([
        'nis' => 'nullable|numeric',
        'nama' => 'required|string',
        'jurusan' => 'nullable|string',
        'id_kelas' => 'nullable|string', // ini digunakan untuk pencocokan id_kelas
        'paralel' => 'nullable|string',
        'alamat' => 'nullable|string',
        'email' => 'nullable|email:dns|unique:users,email',
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Jika kelas kosong → GURU
    if (empty($validatedData['id_kelas']) && !empty($validatedData['nis'])) {
        $validatedData['nip'] = $validatedData['nis'];
        $validatedData['id_kelas'] = null;
        $validatedData['kelas_detail'] = null;
        unset($validatedData['nis'], $validatedData['kelas'], $validatedData['paralel']);
        $validatedData['id_role'] = 2; // GURU
    }
    // Jika NIS terisi → SISWA
    elseif (!empty($validatedData['nis'])) {
        $kelas = Kelas::where('Kelas', $validatedData['id_kelas'])->first();
        if ($kelas) {
            $validatedData['id_kelas'] = $kelas->id;
        } else {
            return back()->withErrors(['kelas' => 'Kelas tidak ditemukan.'])->withInput();
        }

        $validatedData['id_role'] = 3; // SISWA
    }
    // Jika hanya nama, username, dan password terisi → ADMIN
    elseif (
        empty($validatedData['nis']) &&
        empty($validatedData['nip']) &&
        empty($validatedData['id_kelas']) &&
        empty($validatedData['kelas']) &&
        empty($validatedData['paralel']) &&
        empty($validatedData['jurusan']) &&
        empty($validatedData['alamat']) &&
        empty($validatedData['email'])
    ) {
        $validatedData['id_role'] = 1; // ADMIN BIASA
    }

    // Simpan foto jika ada
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('foto-user', 'public');
        $validatedData['foto'] = $fotoPath;
    }

    $validatedData['password'] = Hash::make($validatedData['password']);

    // dd($validatedData);
    User::create($validatedData);

    return redirect('/login')->with('success', 'Registrasi Berhasil, Silakan Login');
}


}
