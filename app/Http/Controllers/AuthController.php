<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login (guest saja)
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'u_username' => ['required', 'string'],
            'u_password' => ['required', 'string'],
        ], [], [
            'u_username' => 'Username',
            'u_password' => 'Password',
        ]);

        // Coba login menggunakan Auth::attempt()
        if (Auth::attempt([
            'u_username' => $credentials['u_username'],
            'password' => $credentials['u_password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal, kembalikan pesan error ke tampilan login
        return back()->withErrors([
            'login_error' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
