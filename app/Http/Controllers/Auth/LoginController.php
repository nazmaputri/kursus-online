<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Log attempt login
        \Log::info('Login attempt:', ['email' => $request->email]);

        // Cek pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika pengguna tidak ditemukan berdasarkan email
        if (!$user) {
            \Log::error('Login failed: Email tidak ditemukan', ['email' => $request->email]);
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ]);
        }

        // Jika pengguna ditemukan, cek password
        if (Hash::check($request->password, $user->password)) {
            \Log::error('Login failed: Password salah untuk email yang valid', ['email' => $request->email]);
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }

        // Cek apakah email sudah terverifikasi
        if (is_null($user->email_verified_at)) {
            \Log::warning('Login failed: Email belum terverifikasi', ['user_id' => $user->id]);
            return redirect('login')->withErrors(['email' => 'Email Anda belum terverifikasi.']);
        }

        // Cek apakah status pengguna aktif
        if ($user->status !== 'active') {
            \Log::warning('Login failed: Akun tidak aktif', ['user_id' => $user->id]);
            return redirect('login')->withErrors(['email' => 'Akun Anda tidak aktif.']);
        }

        // Jika semua kondisi terpenuhi, login pengguna
        Auth::login($user);
        $request->session()->regenerate(); // Amankan sesi baru

        // Log info user yang berhasil login
        \Log::info('User logged in successfully:', ['user_id' => $user->id, 'role' => $user->role]);

        // Redirect berdasarkan role
        return $this->redirectUserBasedOnRole($user);
    }

    // Redirect berdasarkan role
    protected function redirectUserBasedOnRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('welcome-admin');
            case 'mentor':
                return redirect()->route('welcome-mentor');
            case 'student':
                return redirect()->route('welcome-peserta');
            default:
                Auth::logout(); // Jika role tidak dikenal, logout dan tolak akses
                \Log::error('Unknown role, user logged out:', ['user_id' => $user->id, 'role' => $user->role]);
                return redirect('login')->withErrors(['email' => 'Akses tidak diizinkan.']);
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        $userId = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Log user logout
        \Log::info('User logged out:', ['user_id' => $userId]);

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }
}
