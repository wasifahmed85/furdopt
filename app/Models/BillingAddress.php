<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'first_name',
        'last_name',
        'company_name',
        'street_address1',
        'street_address2',
        'city',
        'state',
        'post_code',
        'phone',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
