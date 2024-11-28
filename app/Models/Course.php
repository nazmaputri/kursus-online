<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'capacity',
        'image_path',
        'mentor_id',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'courses_id', 'id');
    }
}

