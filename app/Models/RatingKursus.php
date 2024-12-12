<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingKursus extends Model
{
    use HasFactory;

    protected $table = 'rating_kursus';

    protected $fillable = [
        'user_id', 
        'course_id', 
        'stars', 
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
