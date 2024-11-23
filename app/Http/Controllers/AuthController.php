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
            'nama' => 'required|alpha|max:32', // hanya huruf, maks 32 karakter
            'alamat' => 'required|alpha_num|min:5', // alphanumeric, minimal 5 karakter
            'noHP' => 'required|numeric|min:10|max:13', // angka saja, minimal 10, maks 13 karakter
            'username' => 'required|alpha_num|unique:anggota,username|min:6|max:32|not_regex:/\s/', // tanpa spasi, unik, minimal 6, maks 32 karakter
            'password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/', // minimum 8 karakter, alphanumeric, dengan @$!%*?& diperbolehkan
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
