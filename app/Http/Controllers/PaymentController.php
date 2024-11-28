<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Auth;
use Log;

class PaymentController extends Controller
{
    public function createPayment(Request $request, $courseId)
    {
        // Ambil kursus berdasarkan course_id
        $course = Course::find($courseId);
    
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
    
        // Pastikan user sudah login
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
    
        // Detail transaksi untuk Midtrans
        $transaction_details = [
            'order_id' => 'EduFlix/ORDER-' . uniqid(),
            'gross_amount' => $course->price,
        ];
    
        $customer_details = [
            'first_name' => $user->name,
            'email' => $user->email,
        ];
    
        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];
    
        try {
            // Mendapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($transaction);
    
            if (!$snapToken) {
                return response()->json(['error' => 'Token not found'], 400);
            }
    
            // Menyimpan pembayaran dan mendapatkan transaction_id dari Snap
            $transactionId = $transaction_details['order_id']; // Atau gunakan ID lain yang diberikan oleh Midtrans
    
            // Menyimpan data pembayaran di database
            $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'amount' => $course->price,
                'payment_type' => 'qris',
                'transaction_status' => 'pending',
                'transaction_id' => $transactionId,
                'snap_token' => $snapToken,
            ]);
    
            return response()->json([
                'snapToken' => $snapToken,
                'transactionId' => $transactionId,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage()], 500);
        }
    }
    
    

    // Fungsi lain yang bisa Anda tambahkan sesuai kebutuhan, seperti untuk menangani notifikasi pembayaran, dll.
}
