<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserDetail;
use App\Models\UkState;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class Profile extends Component
{
    
      use WithFileUploads;
      
    #[Title(' Profile')]
    public $user;
    public $userdetail;
    public $cities;
    public $editdata = false;
    public $availablePet = false;
    public $is_available_pet;
    public $availablePetInhouse;
    public $username;
    public $phone;
    public $gender;
    public $city;
    public $bio;
    
    public $looking_for;
    public $looking_for_breed;
    public $size;
    public $pet_age;
    public $pet_gender;
    public $pet_personality;
    public $specific_activities;
       public $children_age_inhouse;
       public $pet_outdoor_space;
       public $dedicated_time;
       public $special_need;
       public $subCategories;
       public $best_fit_for_home;
       public $best_fit_for_home_deatils;
       public $adoption_reason;
       public $specific_trait_activities;
       public $special_need_yes_details;
       public $avatar;

public function edit()
{
    $this->editdata = true;
    $this->username = Auth::user()->name;
    $this->phone = Auth::user()->phone;
    $this->gender = Auth::user()->gender;
    $this->bio = Auth::user()->userdetails->bio;
    $this->looking_for = Auth::user()->userdetails->looking_for;
    $this->looking_for_breed = Auth::user()->userdetails->looking_for_breed;
    $this->pet_age = Auth::user()->userdetails->pet_age;
    $this->size = Auth::user()->userdetails->size;
    $this->pet_gender = Auth::user()->userdetails->pet_gender;
    $this->pet_personality = Auth::user()->userdetails->pet_personality;
    $this->specific_activities = Auth::user()->userdetails->specific_activities;
    $this->is_available_pet = Auth::user()->userdetails->is_available_pet;
    $this->availablePetInhouse = Auth::user()->userdetails->available_pet_inhouse;
    $this->children_age_inhouse = Auth::user()->userdetails->children_age_inhouse;
    $this->pet_outdoor_space = Auth::user()->userdetails->pet_outdoor_space;
    $this->dedicated_time = Auth::user()->userdetails->dedicated_time;
    $this->special_need = Auth::user()->userdetails->special_need;
    $this->best_fit_for_home = Auth::user()->userdetails->best_fit_for_home;
    $this->best_fit_for_home_deatils = Auth::user()->userdetails->best_fit_for_home_deatils;
    $this->adoption_reason = Auth::user()->userdetails->adoption_reason;
    $this->specific_trait_activities = Auth::user()->userdetails->specific_trait_activities;
    $this->special_need_yes_details = Auth::user()->userdetails->special_need_yes_details;
}
  public function petInHouse($data)
    {
        if ($data == 'Yes') {
            $this->availablePet = true;
            $this->is_available_pet = 'Yes';
        } else {
            $this->availablePet = false;
            $this->is_available_pet = 'No';
        }
    }

  public function updatedLookingForBreed($value)
    {
        $this->looking_for_breed = $value === '' ? null : $value;
    }

public function save()
{
    $this->editdata = false;
    
    
    
    $manager = new ImageManager(new Driver());
        if ($this->avatar) {
            $thumbnailName = uniqid() . '.webp';
            $image = $manager->read($this->avatar->getRealPath())
                ->cover(300, 300)
                ->toWebp(90);

            // Storage::disk('public')->put('images/' . $thumbnailName, (string) $image);
            $imagePath = public_path('images/' . $thumbnailName);
            if (!File::exists(public_path('images'))) {
                File::makeDirectory(public_path('images'), 0777, true, true);
            }
            file_put_contents($imagePath, (string) $image);

            Auth::user()->update([
                'avatar' => $thumbnailName
            ]);
        }
    
     Auth::user()->update([
            'name' => $this->username,
            'gender' => $this->gender,
            'phone' => $this->phone,
             'interested' => $this->looking_for,

        ]);


   UserDetail::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [
               
           
                'bio' => $this->bio,
                'looking_for' => $this->looking_for,
                'looking_for_breed' => $this->looking_for_breed,
                'pet_age' => $this->pet_age,
                'size' => $this->size,
                'pet_gender' => $this->pet_gender,
                'pet_personality' => $this->pet_personality,
                'specific_activities' => $this->specific_activities,
                 'is_available_pet' => $this->is_available_pet,
                    'available_pet_inhouse' => $this->availablePetInhouse,
                      'children_age_inhouse' => $this->children_age_inhouse,
                      'pet_outdoor_space' => $this->pet_outdoor_space,
                      'dedicated_time' => $this->dedicated_time,
                      'special_need' => $this->special_need,
                      'adoption_reason' => $this->adoption_reason,
                      'best_fit_for_home' => $this->best_fit_for_home,
                      'best_fit_for_home_deatils' => $this->best_fit_for_home_deatils,
                      'specific_trait_activities' => $this->specific_trait_activities,
                      'special_need_yes_details' => $this->special_need_yes_details,

            ]
        );
        
}

    public function render()
    {
        $this->user = Auth::user();
        $this->userdetail = UserDetail::where('user_id', Auth::user()->id)->first();
        $this->cities = UkState::all();
      $this->categories = Category::where('status', 1)->get(['id', 'name']);
         $this->subCategories = SubCategory::where('category_id', $this->looking_for)->get();
        return view('livewire.profile');
    }
    
    
    
    
}
