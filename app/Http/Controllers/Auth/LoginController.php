<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        \Log::info('Login attempt:', ['credentials' => $credentials]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Amankan sesi baru

            $user = Auth::user();
            \Log::info('User logged in:', ['role' => $user->role]);

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('welcome-admin');
                case 'mentor':
                    return redirect()->route('welcome-mentor');
                case 'student':
                    return redirect()->route('welcome-peserta');
                default:
                    Auth::logout(); // Jika role tidak dikenal, logout dan tolak akses
                    return redirect('login')->withErrors(['email' => 'Akses tidak diizinkan.']);
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
