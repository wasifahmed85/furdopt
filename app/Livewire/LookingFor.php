<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\UkState;
use App\Models\UserDetail;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;


class LookingFor extends Component
{
    #[Title(' Looking For')]

    public $categories;
    public $states;
    public $size;
    public $looking_for_location;
    public $address;
    // public $selectedCategories = []; 
    public $selectedCategories;
    public $looking_for_age_from;
    public $looking_for_age_to;
    public $looking_for_weight_from;
    public $looking_for_weight_to;
    public $looking_for_height_from;
    public $looking_for_height_to;
    public $looking_for_state;
    public $pet_personality;
    public $pet_sports;
    public $pet_age;
    public $looking_for;
    public $pet_gender;
     public $hobies = [];
     public $sports = [];
     
     public $is_available_pet;
     public $availablePetInhouse;
     public $children_age_inhouse;
     public $special_need;
     public $dedicated_time;
     public $specific_activities;
     public $pet_outdoor_space;
     public $subCategories;
     public $looking_for_breed;
     public $best_fit_for_home;
     public $adoption_reason;
     public $specific_trait_activities;
     public $special_need_yes_details;
   
    public function mount()
    {
       
        $detail = UserDetail::where('user_id', Auth::id())->first();
        $this->categories = Category::where('status', 1)->get(['id', 'name']);
        $this->states = UkState::all();
        $this->looking_for_age_from = $detail->looking_for_age_from;
        $this->looking_for_age_to = $detail->looking_for_age_to;
        $this->looking_for_weight_from = $detail->looking_for_weight_from;
        $this->looking_for_weight_to = $detail->looking_for_weight_to;
        $this->looking_for_height_from = $detail->looking_for_height_from;
        $this->looking_for_height_to = $detail->looking_for_height_to;
        $this->looking_for_location = $detail->looking_for_location;
        $this->looking_for_state = $detail->looking_for_state;
        $this->size = $detail->size;
        $this->pet_age = $detail->pet_age;
        $this->pet_personality = $detail->pet_personality;
        $this->pet_sports = $detail->pet_sports;
        $this->pet_age = $detail->pet_age;
        $this->pet_gender = $detail->pet_gender;
        $this->looking_for = $detail->looking_for;
        $this->is_available_pet = $detail->is_available_pet;
        $this->availablePetInhouse = $detail->available_pet_inhouse;
        $this->children_age_inhouse = $detail->children_age_inhouse;
        $this->special_need = $detail->special_need;
        $this->dedicated_time = $detail->dedicated_time;
        $this->specific_activities = $detail->specific_activities;
        $this->pet_outdoor_space = $detail->pet_outdoor_space;
        $this->children_age_inhouse = $detail->children_age_inhouse;
        $this->looking_for_breed = $detail->looking_for_breed;
        $this->best_fit_for_home = $detail->best_fit_for_home;
        $this->adoption_reason = $detail->adoption_reason;
        $this->specific_trait_activities = $detail->specific_trait_activities;
        $this->special_need_yes_details = $detail->special_need_yes_details;
        
         $this->sports = $detail && $detail->sports ? json_decode($detail->sports, true) : [];
         $this->hobies = $detail && $detail->hobies ? json_decode($detail->hobies, true) : [];
    }


    public function updateData()
    {

        UserDetail::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [

                // 'looking_for' => json_encode($this->selectedCategories),
                'looking_for' => $this->looking_for,
                'pet_gender' => $this->pet_gender,
                'looking_for_age_from' => $this->looking_for_age_from,
                'looking_for_age_from' => $this->looking_for_age_from,
                'looking_for_age_to' => $this->looking_for_age_to,
                'looking_for_weight_from' => $this->looking_for_weight_from,
                'looking_for_weight_to' => $this->looking_for_weight_to,
                'looking_for_height_from' => $this->looking_for_height_from,
                'looking_for_height_to' => $this->looking_for_height_to,
                'looking_for_location' => $this->looking_for_location,
                'looking_for_state' => $this->looking_for_state,
                'size' => $this->size,
                'pet_personality' => $this->pet_personality,
                'pet_sports' => $this->pet_sports,
                'pet_age' => $this->pet_age,
                'is_available_pet' => $this->is_available_pet,
                'looking_for_breed' => $this->looking_for_breed,
                'best_fit_for_home' => $this->best_fit_for_home,
                'adoption_reason' => $this->adoption_reason,
                'special_need_yes_details' => $this->special_need_yes_details,
            
            'specific_trait_activities' => $this->specific_trait_activities,
            'available_pet_inhouse' => $this->availablePetInhouse,
            'children_age_inhouse' => $this->children_age_inhouse,
              'special_need' => $this->special_need,
              'dedicated_time' => $this->dedicated_time,
              'pet_outdoor_space' => $this->pet_outdoor_space,
                'specific_activities' => $this->specific_activities,
                'children_age_inhouse' => $this->children_age_inhouse,
                'sports' => json_encode($this->sports),
                'hobies' => json_encode($this->hobies),
                ]
        );
        
        $this->mount();
    }

    public function render()
    {
         $this->subCategories = SubCategory::where('category_id', $this->looking_for)->get();
        return view('livewire.looking-for');
    }
}
