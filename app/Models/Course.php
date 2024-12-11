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
        'chat',
        'start_date',
        'end_date',
        'image_path',
        'mentor_id',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

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

    public function videos()
    {
        return $this->hasMany(MateriVideo::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }

    public function pdfMaterials()
    {
        return $this->hasMany(MateriPdf::class, 'course_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'course_id');
    }

    // Course.php (Model)
    public function getDurationAttribute()
    {
        // Pastikan start_date dan end_date ada
        if ($this->start_date && $this->end_date) {
            $start = \Carbon\Carbon::parse($this->start_date);
            $end = \Carbon\Carbon::parse($this->end_date);
            
            // Menghitung selisih hari
            $diffInDays = $start->diffInDays($end);
            
            // Bisa juga menghitung durasi dalam format minggu atau bulan jika diperlukan
            // $diffInWeeks = $start->diffInWeeks($end);
            // $diffInMonths = $start->diffInMonths($end);
            
            return $diffInDays . ' hari';
        }

        return 'Akses Seumur Hidup';
    }


}

