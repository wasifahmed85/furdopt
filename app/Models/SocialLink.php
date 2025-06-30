<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'user_id',
        'facebook',
        'facebook_verify',
        'instagram',
        'instagram_verify',
        'youtube',
        'youtube_verify',
        'tiktok',
        'tiktok_verify',
        'snapchat',
        'snapchat_verify',
        'whatsapp',
        'whatsapp_verify',
        'telegram',
        'telegram_verify',
        'google',
        'google_verify',
        'twitter',
        'twitter_verify',
        'linkedin',
        'linkedin_verify',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
