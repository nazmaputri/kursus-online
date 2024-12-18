<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'photo',
        'email',
        'password',
        'phone_number',
        'role',          
        'profesi',       
        'experience', 
        'linkedin',
        'company',
        'years_of_experience',  
        'status', 
        'email_verified_at',       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator untuk hashing password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value) { // Tambahkan ini agar hashing hanya terjadi jika password ada dan perlu diubah
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function managedCourses()
    {
        return $this->hasMany(Course::class, 'mentor_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function materiUsers()
    {
        return $this->belongsToMany(Materi::class, 'materi_user', 'user_id', 'materi_id')
                    ->withTimestamps(); // Memastikan timestamp juga disimpan jika ada
    }
  
}
