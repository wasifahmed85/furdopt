<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $fillable = [
        'user_id',
        'visible_status',
        'new_message_status',
        'new_visitor_status',
        'like_status',
        'match_status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
