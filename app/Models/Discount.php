<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Discount extends Model {

    use HasFactory;

    protected $fillable = [
        'coupon_code',
        'discount_percentage',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'apply_to_all'
    ];

    public function courses() {
        return $this->belongsToMany(Course::class, 'discount_course');
    }
}


