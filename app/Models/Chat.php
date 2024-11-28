<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['student_id', 'mentor_id'];

    // Relasi dengan pesan (message)
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relasi dengan student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relasi dengan mentor
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}


