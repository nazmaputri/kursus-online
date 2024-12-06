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
    
            // Menyimpan pembayaran di database
            Payment::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'amount' => $course->price,
                'payment_type' => 'qris',
                'transaction_status' => 'pending', 
                'transaction_id' => $transaction_details['order_id'],
                'snap_token' => $snapToken,
            ]);
    
            return response()->json([
                'snapToken' => $snapToken,
                'transactionId' => $transaction_details['order_id'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage()], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $transactionStatus = $request->input('transaction_status');

        // Cari transaksi berdasarkan order_id
        $payment = Payment::where('transaction_id', $orderId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Perbarui status pembayaran
        $payment->transaction_status = $transactionStatus;
        $payment->save();

        return response()->json([
            'message' => 'Status pembayaran berhasil diperbarui.',
            'payment' => $payment,
        ]);
    }


}

