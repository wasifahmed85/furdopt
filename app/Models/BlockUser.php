<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model
{
    protected $fillable = ['user_id', 'blocked_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'blocked_user_id', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->whereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', $term);
            // ->orWhere('phone', 'like', $term);
        });
    }
}
