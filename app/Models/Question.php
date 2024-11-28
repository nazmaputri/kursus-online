<?php

// app/Models/Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 
        'question'
    ];

    // Relasi ke tabel answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

