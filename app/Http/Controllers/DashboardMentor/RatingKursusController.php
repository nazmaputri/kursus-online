<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\RatingKursus;
use App\Models\Course;
use Illuminate\Http\Request;

class RatingKursusController extends Controller
{
    public function toggleDisplay($id)
    {
        // Cari rating berdasarkan ID
        $rating = RatingKursus::findOrFail($id);

        // Toggle status display tanpa memeriksa pemilik rating, karena siapapun yang login dapat mengubah statusnya
        $rating->display = !$rating->display;
        $rating->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tampilan komentar berhasil diperbarui.');
    }

    public function store(Request $request, $course_id)
    {
        // Validasi input
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',  // Rating bintang harus antara 1 dan 5
            'comment' => 'nullable|string|max:1000',    // Komentar opsional dan maksimal 1000 karakter
        ]);

        // Menyimpan rating ke database
        RatingKursus::create([
            'user_id' => auth()->id(),  // ID pengguna yang sedang login
            'course_id' => $course_id,  // ID kursus yang sedang diberi rating
            'stars' => $request->stars, // Nilai rating yang diberikan
            'comment' => $request->comment, // Komentar yang diberikan (opsional)
        ]);

        // Redirect dengan notifikasi sukses
        return redirect()->route('detail-kursus', ['id' => $course_id])
                        ->with('success', 'Rating berhasil disimpan!');
    }
}
