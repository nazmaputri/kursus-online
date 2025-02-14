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
            'password' => 'required|string|min:8', // Memastikan password dan konfirmasi sama
            'password_confirmation' => 'required',
            'phone_number' => 'required|string|max:15',
            'role' => 'required|in:student,mentor', // Validasi role yang diinput
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
        
            'email.required' => 'Email harus diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
        
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password_confirmation' => 'Konfirmasi password tidak cocok.',
        
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',
            'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',        
        ]);

        // Validasi tambahan jika role adalah mentor
        if ($request->role === 'mentor') {
            $request->validate([
                'profesi' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'years_of_experience' => 'nullable|integer',
            ], [
                'profesi.required' => 'Profesi harus diisi.',
                'profesi.string' => 'Profesi harus berupa teks.',
                'profesi.max' => 'Profesi tidak boleh lebih dari 255 karakter.',

                'experience.required' => 'Pengalaman harus diisi.',
                'experience.string' => 'Pengalaman harus berupa teks.',
                'experience.max' => 'Pengalaman tidak boleh lebih dari 255 karakter.',

                'linkedin.string' => 'LinkedIn harus berupa teks.',
                'linkedin.max' => 'LinkedIn tidak boleh lebih dari 255 karakter.',

                'company.string' => 'Nama perusahaan harus berupa teks.',
                'company.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',

                'years_of_experience.integer' => 'Tahun pengalaman harus berupa angka.',
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
            ? 'Permintaan Anda akan disetujui oleh admin dalam 1x24 jam, tunggu notifikasi dari email anda agar bisa menjadi mentor.'
            : 'Pendaftaran berhasil. Silakan login.';

        // Cek apakah admin yang menambahkan
        if ($request->has('added_by_admin')) {
            return redirect()->route('datamentor-admin')->with('success', 'Mentor berhasil ditambahkan!');
        }

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', $message);
    }

}
