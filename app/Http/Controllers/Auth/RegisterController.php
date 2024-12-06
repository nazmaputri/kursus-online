<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form pendaftaran untuk student
    public function show()
    {
        return view('auth.register');
    }

    // Menampilkan form pendaftaran untuk mentor
    public function showmentor()
    {
        return view('auth.register-mentor');
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        // Validasi input pendaftaran
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Memastikan password dan konfirmasi sama
            'phone_number' => 'nullable|string|max:15',
            'course' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'role' => 'required|in:student,mentor', // Validasi role yang diinput
        ]);

        // Atur status berdasarkan role
        $status = $validatedData['role'] === 'mentor' ? 'pending' : 'active';

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash password di sini
            'phone_number' => $validatedData['phone_number'],
            'role' => $validatedData['role'],
            'status' => $status,
            'email_verified_at' => now(), 
            // 'course' => $validatedData['course'],
            // 'experience' => $validatedData['experience'],
        ]);

         // Redirect dan tampilkan notifikasi khusus mentor
         $message = $validatedData['role'] === 'mentor' 
         ? 'Permintaan Anda akan disetujui oleh admin dalam 1x24 jam, tunggu notifikasi selanjutnya agar bisa menjadi mentor.' 
         : 'Pendaftaran berhasil. Silakan login.';

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}
