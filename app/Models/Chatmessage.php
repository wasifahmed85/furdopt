<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatmessage extends Model
{
    use HasFactory;

    protected $fillable = [

        'message',
        'user_id',
        'sender_id',
        'receiver_id',
        'is_seen',
        'media',
    ];


    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }



    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
