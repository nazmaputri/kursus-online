<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouTube extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan plural dari nama model
    protected $table = 'youtube';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'judul', 
        'link_youtube', 
        'materi_id', 
        'course_id'
    ];

    // Relasi ke model Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    // Relasi ke model Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
