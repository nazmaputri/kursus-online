<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chat_id', 
        'sender_id', 
        'message', 
        'is_read'
    ];

    // Relasi dengan chat
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}

