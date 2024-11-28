<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'course_id',  
        'payment_type', 
        'transaction_status', 
        'transaction_id', 
        'amount',
        'payment_url'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Menambahkan accessor untuk mendapatkan status pembayaran secara lebih mudah
    // public function getPaymentStatusAttribute()
    // {
    //     switch ($this->transaction_status) {
    //         case 'settlement':
    //             return 'Pembayaran Berhasil';
    //         case 'pending':
    //             return 'Pembayaran Sedang Diproses';
    //         case 'cancel':
    //             return 'Pembayaran Dibatalkan';
    //         default:
    //             return 'Status Tidak Dikenal';
    //     }
    // }

    // Menambahkan mutator untuk harga yang diformat secara otomatis
    // public function getAmountFormattedAttribute()
    // {
    //     return number_format($this->amount, 0, ',', '.');
    // }
}
