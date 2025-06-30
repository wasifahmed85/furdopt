<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileVisible extends Model
{
    protected $fillable = [
        'user_id',
        'profile_visible_status',
        'profile_online_status',
    ];
}
