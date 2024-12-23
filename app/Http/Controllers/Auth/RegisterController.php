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
            'role' => 'required|in:student,mentor', // Validasi role yang diinput
        ]);
    
        // Validasi tambahan jika role adalah mentor
        if ($request->role === 'mentor') {
            $mentorData = $request->validate([
                'profesi' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'years_of_experience' => 'nullable|integer',
            ]);
        } else {
            // Defaultkan nilai untuk student
            $mentorData = [
                'profesi' => null,
                'experience' => null,
                'linkedin' => null,
                'company' => null,
                'years_of_experience' => null,
            ];
        }
    
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
            'profesi' => $mentorData['profesi'],
            'experience' => $mentorData['experience'],
            'linkedin' => $mentorData['linkedin'],
            'company' => $mentorData['company'],
            'years_of_experience' => $mentorData['years_of_experience'],
        ]);
    
        // Redirect dan tampilkan notifikasi khusus mentor
        $message = $validatedData['role'] === 'mentor'
            ? 'Permintaan Anda akan disetujui oleh admin dalam 1x24 jam, tunggu notifikasi selanjutnya agar bisa menjadi mentor.'
            : 'Pendaftaran berhasil. Silakan login.';
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', $message);
    }
    
    
}
