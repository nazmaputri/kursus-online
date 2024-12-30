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

    public function register(Request $request)
    {
        // Validasi input pendaftaran
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Memastikan password dan konfirmasi sama
            'phone_number' => 'nullable|string|max:15',
            'role' => 'required|in:student,mentor', // Validasi role yang diinput
        ]);

        // Validasi tambahan jika role adalah mentor
        if ($request->role === 'mentor') {
            $request->validate([
                'profesi' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'years_of_experience' => 'nullable|integer',
            ]);
        }

        // Atur status berdasarkan role
        $status = $request->role === 'mentor' ? 'pending' : 'active';

        // Buat pengguna baru dengan data dari request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password langsung dari request
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'status' => $status,
            'email_verified_at' => now(),
            'profesi' => $request->profesi ?? null,
            'experience' => $request->experience ?? null,
            'linkedin' => $request->linkedin ?? null,
            'company' => $request->company ?? null,
            'years_of_experience' => $request->years_of_experience ?? null,
        ]);

        // Redirect dan tampilkan notifikasi khusus mentor
        $message = $request->role === 'mentor'
            ? 'Permintaan Anda akan disetujui oleh admin dalam 1x24 jam, tunggu notifikasi selanjutnya agar bisa menjadi mentor.'
            : 'Pendaftaran berhasil. Silakan login.';

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', $message);
    }

}
