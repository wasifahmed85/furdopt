<?php

namespace App\Models;

use App\Enums\PrivacyOption;
use Illuminate\Database\Eloquent\Model;


class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'pet_owner_type',
        'verify_breeder_status',
        'breeder_license_no',
        'age',
        'age_status',
        'country_id',
        'country_status',
        'city',
        'city_status',
        'location',
        'first_name',
        'last_name',
        'seeking',
        'married_status',
        'education',
        'specialist',
        'bio',
        'role',
        'gender',
        'dob',
        'height',
        'weight',
        'language',
        'sports',
        'children',
        'religion',
        'hobies',
        'looking_for',
        'looking_for_breed',
        'looking_for_age_from',
        'looking_for_age_to',
        'looking_for_weight_from',
        'looking_for_weight_to',
        'looking_for_height_from',
        'looking_for_height_to',
        'looking_for_religion',
        'looking_for_married_status',
        'looking_for_language',
        'looking_for_education',
        'looking_for_location',
        'looking_for_state',
        'size',
        'pet_sports',
        'pet_personality',
        'pet_age',
        'is_available_pet',
        'available_pet_inhouse',
        'children_age_inhouse',
        'pet_outdoor_space',
        'specific_activities',
        'dedicated_time',
        'special_need',
        'special_need_yes_details',
        'Rehoming_centre_id',
        'rehoming_centre',
        'rehome_type',
        'pet_gender',
        'best_fit_for_home',
        'best_fit_for_home_deatils',
        'adoption_reason',
        'specific_trait_activities',
        'special_need_yes_details',
        'rehome_centre_p',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function state()
    {
        return $this->belongsTo(UkState::class, 'looking_for_state');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'looking_for');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'looking_for_breed');
    }
    public function pet()
    {
        return $this->hasMany(Pet::class, 'user_id', 'owner_id');
    }

    protected $casts = [
        'age_status' => PrivacyOption::class,
        'country_status' => PrivacyOption::class,
        'city_status' => PrivacyOption::class,
    ];

    public function getPrivacyLabel(string $field): ?string
    {

        if (isset($this->attributes[$field]) && $this->casts[$field] === PrivacyOption::class) {
            $status = $this->{$field};
            return $status->label();
        }

        return null;
    }
}
