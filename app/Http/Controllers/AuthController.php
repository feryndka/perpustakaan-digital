<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaAuthVerifyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
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
