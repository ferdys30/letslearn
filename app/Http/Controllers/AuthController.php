<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mata_pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function login(){
    return view('auth/login', ['tittle' => 'Login']);
}

public function regist(){
    return view('auth/regist', ['tittle' => 'Regist']);
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

        // Arahkan ke halaman berbeda berdasarkan apakah user memiliki 'nip'
        $user = Auth::user();
            if ($user->nip) {
                return redirect()->intended('/guru');
            }

        return redirect()->intended('/');
    }

    return back()->with('LoginError', 'Gagal Login!');
}



public function store(Request $request)
{
    $validatedData = $request->validate([
        'nis' => 'required',
        'nama' => 'required',
        'jurusan' => 'required',
        'kelas' => 'nullable', // kelas boleh kosong
        'alamat' => 'required',
        'email' => 'required|email:dns',
        'username' => 'required',
        'password' => 'required',
    ]);

    // Jika kelas tidak diisi, asumsikan ini guru: pindahkan NIS ke NIP
    if (empty($validatedData['kelas'])) {
        $validatedData['nip'] = $validatedData['nis'];
        unset($validatedData['nis']); // hapus nis dari data
    }

    User::create($validatedData);

    return redirect('/login')->with('success', 'Registrasi Berhasil, Silakan Login');
}

}
