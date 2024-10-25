<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form pendaftaran
    public function show()
    {
        return view('auth.register');
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        // Validasi input pendaftaran
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'role' => 'required|in:student,mentor', 
            'course' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
        ]);

        // Atur status berdasarkan role
        if ($validatedData['role'] === 'mentor') {
            $validatedData['status'] = 'pending'; // Status mentor adalah pending
        } else {
            $validatedData['status'] = 'approved'; // Status student adalah approved
        }

        // Buat pengguna baru
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone_number' => $validatedData['phone_number'],
            'role' => $validatedData['role'],
            'course' => $validatedData['course'],
            'experience' => $validatedData['experience'],
            'status' => $validatedData['status'],
        ]);

        // Redirect ke halaman dashboard
        return redirect()->route('dashboard-peserta')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
