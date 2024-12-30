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

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Cek pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();
    
        // Jika pengguna tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->withInput($request->except('password'));
        }
    
        // Cek apakah password cocok dengan hash yang ada di database
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->withInput($request->except('password'));
        }
    
        // Cek apakah email sudah terverifikasi
        if (is_null($user->email_verified_at)) {
            return back()->withErrors(['email' => 'Email Anda belum terverifikasi.']);
        }
    
        // Cek apakah status pengguna aktif
        if ($user->status !== 'active') {
            return back()->withErrors(['email' => 'Akun Anda tidak aktif.']);
        }
    
        // Login pengguna dan amankan sesi baru
        $request->session()->regenerate();
    
        // Redirect berdasarkan role
        switch ($user->role) {
            case 'admin':
                Auth::guard('admin')->login($user); 
                return redirect()->route('welcome-admin');
            
            case 'mentor':
                Auth::guard('mentor')->login($user); 
                return redirect()->route('welcome-mentor');
            
            case 'student':
                Auth::guard('student')->login($user);  
                return redirect()->route('welcome-peserta');
            
            default:
                // Jika role tidak dikenal, logout dan tolak akses
                Auth::logout();
                return redirect('login')->withErrors(['email' => 'Role tidak dikenal.']);
        }
    }    

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function logoutMentor(Request $request)
    {
        Auth::guard('mentor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }

}
