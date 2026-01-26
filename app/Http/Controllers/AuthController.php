<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Gunakan format email yang benar!',
            'password.required' => 'Password wajib diisi!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            sweetalert()->info('Selamat datang '.Auth::user()->name.'!');

            return redirect()->intended('/dashboard');
        } else {
            sweetalert()->error('Login Gagal! Email atau Password Salah!');

            return redirect('/login')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        sweetalert()->success('Berhasil logout!');

        return redirect('/login');
    }
}
