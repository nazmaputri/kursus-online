<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    // Menampilkan Sertifikat
    public function showCertificate($courseId)
    {
        $userId = auth()->id(); // Mendapatkan ID user yang login

        // Ambil data course berdasarkan courseId
        $course = Course::findOrFail($courseId);

        // Data untuk sertifikat
        $data = [
            'participant_name'       => $userId ? auth()->user()->name : 'Nama Peserta Tidak Diketahui',  // Nama peserta
            'course_title'           => $course->title,
            'course_category'        => $course->category,
            'course_start_date'      => $course->start_date,
            'course_end_date'        => $course->end_date,
            'mentor_name'            => $course->mentor->name ?? 'Tidak Diketahui',
            'signature_title_left'   => 'Direktur Kursus',
            'signature_title_right'  => 'Mentor Kursus',
        ];

        // Mengembalikan view untuk sertifikat
        return view('dashboard-mentor.sertifikat', $data);
    }
    
    // Mengunduh Sertifikat
    public function downloadCertificate($courseId)
    {
        $userId = auth()->id();

        // Cek transaksi pembayaran
        $payment = Payment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('transaction_status', 'success') // Gunakan status 'success' untuk konsistensi
            ->firstOrFail();

        $course = $payment->course;

        // Data untuk sertifikat
        $data = [
            'participant_name'       => $payment->user->name,
            'course_title'           => $course->title,
            'course_category'        => $course->category,
            'course_start_date'      => $course->start_date,
            'course_end_date'        => $course->end_date,
            'mentor_name'            => $course->mentor->name ?? 'Tidak Diketahui',
            'signature_title_left'   => 'Direktur Kursus',
            'signature_title_right'  => 'Mentor Kursus',
        ];

       // Menggunakan DOMPDF untuk membuat sertifikat PDF dengan ukuran landscape
        $pdf = Pdf::loadView('dashboard-mentor.sertifikat', $data)
        ->setPaper('a4', 'landscape');

        return $pdf->download('certificate.pdf');        
    }
}
