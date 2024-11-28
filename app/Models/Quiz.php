<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Nama tabel, jika berbeda dengan penamaan default
    protected $table = 'quizzes';

    // Kolom yang bisa diisi
    protected $fillable = [
        'title',
        'description',
        'course_id',
        'materi_id',
        'duration',
    ];

    // Relasi dengan model Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi dengan model Question 
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relasi dengan materi
    public function materi()
    {
        return $this->belongsTo(Materi::class); 
    }
}
