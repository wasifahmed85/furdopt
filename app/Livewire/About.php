<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    public  $countries;
    public  $age;
    public  $age_status;
    public  $country_id;
    public  $country_status;
    public  $city;
    public  $city_status;
    #[Title(' About')]


    public function mount()

    {
        $this->countries = Country::select(['id', 'name'])->get();
    }

    public function updateAbout()
    {
        $userDetails = UserDetail::where('user_id', Auth::user()->id)->first();
        $userDetails->update([
            'age' => $this->age,
            'age_status' => $this->age_status,
            'country_id' => $this->country_id,
            'country_status' => $this->country_status,
            'city' => $this->city,
            'city_status' => $this->city_status,
        ]);
    }
    public function render()
    {

        return view('livewire.about');
    }
}
