<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SettingController extends Controller
{
    public function admin()
    {
        $user = Auth::user();
        
        return view('dashboard-admin.setting', compact('user'));
    }

    public function mentor()
    {
        $user = Auth::user();
        
        return view('dashboard-mentor.setting', compact('user'));
    }

    public function student()
    {
        $user = Auth::user();
        
        return view('dashboard-peserta.setting', compact('user'));
    }
    
    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Cek jika ada gambar baru
        if ($request->hasFile('photo')) {
            // Hapus gambar lama jika ada
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan gambar baru dan dapatkan pathnya
            $user->photo = $request->file('photo')->store('images/profile', 'public');
        }

        // Simpan perubahan user
        $user->save();

        // Redirect berdasarkan role user
        if ($user->hasRole('admin')) {
            // Jika user adalah admin
            return redirect()->route('welcome-admin')->with('success', 'Profil berhasil diperbarui!');
        } elseif ($user->hasRole('mentor')) {
            // Jika user adalah mentor
            return redirect()->route('welcome-mentor')->with('success', 'Profil berhasil diperbarui!');
        } elseif ($user->hasRole('student')) {
            // Jika user adalah peserta
            return redirect()->route('welcome-peserta')->with('success', 'Profil berhasil diperbarui!');
        }

        // Jika role tidak ditemukan, arahkan ke halaman default
        return redirect()->route('welcome-admin')->with('success', 'Profil berhasil diperbarui!');
    }
}