<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaAuthVerifyRequest;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|regex:/^[A-Za-z\s]+$/|max:32', // maks 32 karakter
            'alamat' => 'required|min:5', // minimal 5 karakter
            'noHP' => 'required|min:10|max:13', // minimal 10, maks 13 karakter
            'username' => 'required|unique:anggota,username|min:6|max:32|not_regex:/\s/', // unik, minimal 6, maks 32 karakter, tanpa spasi
            'password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/', // minimum 8 karakter, alphanumeric, dengan @$!%*?& diperbolehkan
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.min' => 'Alamat harus memiliki minimal :min karakter.',

            'noHP.required' => 'Nomor Telepon harus diisi.',
            'noHP.min' => 'Nomor Telepon harus memiliki minimal :min karakter.',
            'noHP.max' => 'Nomor Telepon tidak boleh lebih dari :max karakter.',

            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.min' => 'Username harus memiliki minimal :min karakter.',
            'username.max' => 'Username tidak boleh lebih dari :max karakter.',
            'username.not_regex' => 'Username tidak boleh mengandung spasi.',

            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter khusus @$!%*?&',
        ]);

        Anggota::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noHP' => $request->noHP,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect(route('login'));
    }

    public function verify(AnggotaAuthVerifyRequest $request)
    {
        $data = $request->validated();

        if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        } else if (Auth::guard('user')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'user'])) {
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        } else {
            return redirect(route('login'))->with('msg', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect(route('login'));
    }
}
