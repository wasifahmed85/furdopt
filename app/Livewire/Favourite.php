<?php

namespace App\Livewire;

use App\Models\Pet;
use App\Models\PetLike;
use Livewire\Component;
use App\Models\UserDetail;
use App\Models\Category;
use App\Models\UkState;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;

class Favourite extends Component
{
    use WithPagination;

    #[Title(' Favourite')]
    #[Layout('components.layouts.app')]
    

    public $search = '';
    public $pet_gender, $looking_for, $pet_age, $looking_for_state, $size, $pet_personality, $pet_sports, $looking_for_location, $name;
    public $pet_genders, $looking_fors, $pet_ages, $looking_for_states, $sizes, $pet_personalitys, $pet_sportss, $looking_for_locations, $names;
    public $pet_genderf, $looking_forf, $pet_agesf, $looking_for_statesf, $sizesf, $pet_personalitysf, $pet_sportssf, $looking_for_locationsf, $namesf;

    public function mount()
    {
        $user = UserDetail::where('user_id', Auth::id())->first();

        if ($user) {
            $this->pet_gender = $user->pet_gender;
            $this->looking_for = $user->looking_for;
            $this->pet_age = $user->pet_age;
            $this->looking_for_state = $user->looking_for_state;
            $this->size = $user->size;
            $this->pet_personality = $user->pet_personality;
            $this->pet_sports = $user->pet_sports;
            $this->looking_for_location = $user->looking_for_location;
        }
        
        $this->pet_genders = Request::get('pet_genders', '');
        $this->looking_fors = Request::get('looking_fors', '');
        $this->pet_ages = Request::get('pet_ages', '');
        $this->looking_for_states = Request::get('looking_for_states', '');
        $this->sizes = Request::get('sizes', '');
        $this->pet_personalitys = Request::get('pet_personalitys', '');
        $this->pet_sportss = Request::get('pet_sportss', '');
        $this->looking_for_locations = Request::get('looking_for_locations', '');
    }

    public function resetSearch()
    {
        $this->pet_genders = '';
        $this->looking_fors = '';
        $this->pet_ages = '';
        $this->looking_for_states = '';
        $this->sizes = '';
        $this->pet_personalitys = '';
        $this->pet_sportss = '';
        $this->looking_for_locations = '';
        $this->names = '';
        $this->pet_gendersf = '';
        $this->looking_forsf = '';
        $this->pet_agesf = '';
        $this->looking_for_statesf = '';
        $this->sizesf = '';
        $this->pet_personalitysf = '';
        $this->pet_sportssf = '';
        $this->looking_for_locationsf = '';
        $this->namesf = '';
    }

    public function searchMatch()
    {
        //  return redirect()->route('f.match', [
        //       'pet_genders' => $this->pet_genders,
        //       'looking_fors' => $this->looking_fors,
        //       'pet_ages' => $this->pet_ages,
        //       'looking_for_states' => $this->looking_for_states,
        //       'sizes' => $this->sizes,
        //       'pet_personalitys' => $this->pet_personalitys,
        //       'pet_sportss' => $this->pet_sportss,
        //       'looking_for_locations' => $this->looking_for_locations,
        // ]);
        
        $this->pet_genderf = $this->pet_genders;
        $this->looking_forf = $this->looking_fors; 
        $this->pet_agesf = $this->pet_ages; 
        $this->looking_for_statesf = $this->looking_for_states;
        $this->sizesf = $this->sizes; 
        $this->pet_personalitysf = $this->pet_personalitys; 
        $this->pet_sportssf = $this->pet_sportss; 
        $this->looking_for_locationsf = $this->looking_for_locations; 
        
    }

    public function render()
    {


        $matchedPetIds = PetLike::where('user_id',Auth::user()->id)->pluck('pet_id');


        $query = Pet::whereIn('id', $matchedPetIds);

        if ($this->looking_fors) {
            $query->where('category_id', $this->looking_fors);
        }
        if ($this->pet_genders) {
            $query->where('gender', $this->pet_genders);
        }
        if ($this->pet_ages) {
            $query->where('age', $this->pet_ages);
        }
        if ($this->looking_for_states) {
            $query->where('uk_state_id', $this->looking_for_states);
        }
        if ($this->sizes) {
            $query->where('size', $this->sizes);
        }
        if ($this->pet_personalitys) {
            $query->where('personality', $this->pet_personalitys);
        }
        if ($this->pet_sportss) {
            $query->where('sports', $this->pet_sportss);
        }
        if ($this->looking_for_locations) {
            $query->where('location', $this->looking_for_locations);
        }
        // search
        if (!empty($this->looking_forsf)) {
            $query->where('category_id', $this->looking_forsf);
        }
        if (!empty($this->pet_gendersf)) {
            $query->where('gender', $this->pet_gendersf);
        }
        if (!empty($this->pet_ages)) {
            $query->where('age', $this->pet_ages);
        }
        if (!empty($this->looking_for_statesf)) {
            $query->where('uk_state_id', $this->looking_for_statesf);
        }
        if (!empty($this->sizesf)) {
            $query->where('size', $this->sizesf);
        }
        if (!empty($this->pet_personalitysf)) {
            $query->where('personality', $this->pet_personalitysf);
        }
        if (!empty($this->pet_sportssf)) {
            $query->where('sports', $this->pet_sportssf);
        }
       
         if (!empty($this->looking_for_locations)) {
        $query->where('location', $this->looking_for_locations );
    }

        $matchedPets = $query->paginate(16);




        return view('livewire.favourite', [
            // 'matchedPets2' => $matchedPets2,
            'matchedPets' => $matchedPets,
            'categoreis' => Category::where('status', 1)->get(),
            'states' => UkState::get(),
        ]);
    }



}
