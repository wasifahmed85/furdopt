<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use Sluggable, HasFactory;
    protected $fillable = [
        'owner_id',
        'category_id',
        'sub_category_id',
        'uk_state_id',
        'name',
        'charity_name_admin',
        'slug',
        'age',
        'size',
        'location',
        'map_link',
        'about',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'gender',
        'price_type',
        'price',
        'price_from',
        'price_to',
        'description',
        'is_featured',
        'is_top_search',
        'status',
        'likes',
        'advert_id',
        'ad_type',
        'tag',
        'health_guarantee',
        'pet_insurance',
        'microchipped_status',
        'neutered_status',
        'vaccinations_status',
        'worm_status',
        'health_checked',
        'special_medical_care',
        'registered',
        'feature_list',
        'thumbnail',
        'website_link',
        'personality',
        'sports',
        'weight',
        'colour',
        'dob',
        'pet_listing_type',
        'charity_name',
        'size_seeking',
        'iscomportable_other_pet',
        'iscomportable_details',
        'iscomportable_children',
        'why_rehome',
        'best_fit_for_home',
        'best_fit_for_home_deatils',
        'need_outdoor_space',
        'specific_activities',
        'iscomportable_other_pet_cat',
        'iscomportable_other_pet_cat_details',
        'iscomportable_others_pets',
        'iscomportable_others_pet_details',
        'dedicated_time',
        'isPublished',
        'special_details',
        'position',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function userd()
    {
        return $this->belongsTo(UserDetail::class, 'owner_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function breed()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id')->withDefault();
    }


    public function state()
    {
        return $this->belongsTo(UkState::class, 'uk_state_id', 'id');
    }

    public function promotions()
    {
        return $this->hasMany(PetPromotion::class);
    }
    public function spotlight()
    {
        return $this->hasMany(PetSoptlight::class, 'pet_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(PetLike::class);
    }
    public function reports()
    {
        return $this->hasMany(PetReport::class);
    }
    public function images()
    {
        return $this->hasMany(PetImage::class);
    }



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
