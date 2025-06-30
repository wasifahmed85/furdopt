<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use App\Models\Category;
use App\Models\Country;
use App\Models\UkState;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{

    public $currentStep = 1;
    public $gender;
    public $interested;
    public $cities;
    public $age_from;
    public $age_to;
    public $age;

    public $username;
    #[Validate('required|email|unique:users,email')]
    public $email;
    public $name;
    public $password;
    public $password_confirmation;
    public $countries;
    public $categories;
    public $pet_owner_type;
    public $city;
    public $phone;
    public $size;
    public $availablePet = false;
    public $is_available_pet;
    public $availablePetInhouse;
    public $children_age_inhouse;
    public $pet_personality;
    public $pet_outdoor_space;
    public $CheckeedspecificActivities;
    public $specific_activities;
    public $dedicated_time;
    public $special_need;
    public $pet_age;
    public $Rehoming_centre_id;
    public $pet_gender;

    #[Title(' Register')]

    public bool $showPassword = false;

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
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

    public function firstStepSubmit()

    {

        // dd($this->country);
        $validatedData = $this->validate([
            'pet_owner_type' => 'required',
            'interested' => 'required',
            // 'gender' => 'required',
            'city' => 'required',
            'phone' => 'required|digits_between:8,15',
            'email' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            // 'age_to' => 'required',

        ]);



        $this->currentStep = 2;
    }




    public function updatedEmail($value)
    {
        $this->generateUniqueUsername($value);
    }

    public function generateUniqueUsername($email)
    {
        $baseUsername = Str::before($email, '@');
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $this->username = $username;
    }



    public function submitForm()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);



        $store =   User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'userrole' => 'owner',
            'username' => $this->username,
            'password' => bcrypt($this->password),
            'interested' => $this->interested,
            'uk_state_id' => $this->city,
            'pet_owner_type' => $this->pet_owner_type,
            'gender' => $this->gender,
            'Rehoming_centre_id' => $this->Rehoming_centre_id,

        ]);

        UserDetail::create([
            'user_id' => $store->id,
            'pet_owner_type' => $this->pet_owner_type,
            'looking_for' => $this->interested,
            'size' => $this->size,
            'pet_age' => $this->age,
            'is_available_pet' => $this->is_available_pet,
            'available_pet_inhouse' => $this->availablePetInhouse,
            'children_age_inhouse' => $this->children_age_inhouse,
            'pet_personality' => $this->pet_personality,
            'pet_outdoor_space' => $this->pet_outdoor_space,
            'specific_activities' => $this->specific_activities,
            'dedicated_time' => $this->dedicated_time,
            'special_need' => $this->special_need,
            'pet_age' => $this->pet_age,
            'pet_gender' => $this->pet_gender,
            'looking_for_state' => $this->city,
            'Rehoming_centre_id' => $this->Rehoming_centre_id,
        ]);


        $this->reset();
        $this->currentStep = 1;
        Auth::login($store);
        return redirect()->route('f.profile');
        // $this->redirectRoute('f.login');
    }


    public function render()
    {
        $this->categories = Category::where('status', 1)->get(['id', 'name']);
        $this->cities = UkState::all();
        $this->username = $this->username;
        return view('livewire.register');
    }
}
