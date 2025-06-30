<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $fillable = [
        'user_id',
        'verification_status',
        'new_message_status',
        'new_visitor_status',
        'like_status',
        'match_status',
        'promotion_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
