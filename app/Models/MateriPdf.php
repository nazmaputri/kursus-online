<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPdf extends Model
{
    use HasFactory;

    protected $table = 'materi_pdf'; 

    protected $fillable = [
        'judul',
        'materi_id', 
        'pdf_file'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
