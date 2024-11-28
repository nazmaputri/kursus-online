<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan User
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Relasi dengan Course
            $table->string('payment_type'); // Jenis pembayaran, seperti 'qris', 'credit_card', dll
            $table->string('transaction_status'); // Status transaksi dari Midtrans (pending, success, failed)
            $table->string('transaction_id')->unique(); // ID transaksi dari Midtrans
            $table->decimal('amount', 15, 2); // Jumlah yang dibayar
            $table->string('payment_url')->nullable(); // URL pembayaran jika menggunakan Midtrans
            $table->timestamps(); // Waktu transaksi
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}