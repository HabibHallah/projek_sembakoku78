<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.auth-login-basic');
    }

    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Menangani proses login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerasi sesi untuk mencegah session fixation
            $request->session()->regenerate();

            // Ambil data user yang login
            $user = Auth::user();

            // Cek role pengguna setelah login
            if ($user->role === 'admin') {
                // Jika role admin, redirect ke dashboard admin
                return redirect()->route('dashboard-analytics');
            } elseif ($user->role === 'user') {
                // Jika role user, redirect ke landing page (sebagai pengguna yang sudah login)
                return redirect('/')->with('status', 'Anda berhasil login sebagai user.');
            }
        }

        // Menangani jika login gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Logout dan invalidasi session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman landing page
        return redirect('/');
    }   
}
