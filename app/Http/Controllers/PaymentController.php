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
    public function createPayment(Request $request)
    {
        // Validasi amount yang dikirim
        $amount = $request->input('amount');
        if (!$amount || !is_numeric($amount)) {
            return response()->json(['error' => 'Invalid amount'], 400);
        }

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); // Pastikan serverKey diambil dari .env
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY'); // Pastikan clientKey diambil dari .env
        Config::$isProduction = false; // Gunakan false untuk mode sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Detail transaksi
        $transaction_details = [
            'order_id' => 'ORDER-' . time(), // ID unik transaksi
            'gross_amount' => $amount,
        ];

        // Detail barang
        $item_details = [
            [
                'id' => 'ITEM-001',
                'price' => $amount,
                'quantity' => 1,
                'name' => 'Pembayaran Event',
            ]
        ];

        // Detail customer
        $customer_details = [
            'first_name' => 'Customer',
            'last_name' => 'Example',
            'email' => 'customer@example.com',
            'phone' => '08123456789',
        ];

        // Data transaksi lengkap
        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            // Mendapatkan snap token dari Midtrans
            $snapToken = Snap::getSnapToken($transaction_data);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan detail error
            return response()->json(['error' => 'Gagal mendapatkan token pembayaran', 'message' => $e->getMessage()], 500);
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

