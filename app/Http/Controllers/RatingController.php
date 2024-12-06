<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function toggleDisplay($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->display = !$rating->display; // Toggle antara true dan false
        $rating->save();

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Simpan data ke database
        Rating::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
