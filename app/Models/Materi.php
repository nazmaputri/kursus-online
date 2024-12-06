<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'judul', 
        'deskripsi', 
        'courses_id'
    ];

    public function videos()
    {
        return $this->hasMany(MateriVideo::class);
    }

    public function pdfs()
    {
        return $this->hasMany(MateriPdf::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courses_id', 'id');
    }
}