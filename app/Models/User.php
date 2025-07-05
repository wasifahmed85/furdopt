<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'username',
        'interested',
        'country_id',
        'age_from',
        'age_to',
        'userrole',
        'last_login_at',
        'last_logout_at',
        'active_status',
        'gender',
        'spotlight',
        'verify_status',
        'uk_state_id',
        'pet_owner_type',
        'phone',
        'rehome_type',
    
        'Rehoming_centre_id',
        'rehoming_centre',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chatmessage::class, 'user_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chatmessage::class, 'receiver_id', 'id');
    }
    
public function lastMessage()
{
    return $this->hasOne(Chatmessage::class, 'user_id', 'id')
        ->orWhere('receiver_id', $this->id)
        ->latest();
}

    public function userdetails()
    {
        return $this->hasOne(UserDetail::class);
    }
    public function billing()
    {
        return $this->hasOne(BillingAddress::class);
    }
    public function social()
    {
        return $this->hasOne(SocialLink::class);
    }

    public function pushNotification()
    {
        return $this->hasOne(PushNotification::class);
    }
    public function emailNotification()
    {
        return $this->hasOne(EmailNotification::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function state()
    {
        return $this->belongsTo(UkState::class, 'uk_state_id');
    }

    public function unreadMessages()
    {
        return $this->receivedChats()->where('is_seen', 0)->where('user_id', Auth::user()->id);
    }

    public function promotePayments()
    {
        return $this->hasMany(PromotePayment::class);
    }
}
