<?php

namespace App\Livewire;

use App\Models\Pet;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use App\Models\UserDetail;
use App\Models\UkState;
use Illuminate\Support\Facades\Auth;

class Search extends Component
{
    #[Title(' Search')]
    public $min_age;
    public $max_age;
    public $gender;
    public $location;
    public $categories;

    public $search = '';
    public $userd;
    public $pet_gender, $looking_for, $pet_age, $looking_for_state, $size, $pet_personality, $pet_sports, $looking_for_location, $name;
    public $pet_genders, $looking_fors, $pet_ages, $looking_for_states, $sizes, $pet_personalitys, $pet_sportss, $looking_for_locations, $names;

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
        $this->userd = $user;
        $this->categories = Category::all();
    }
    public function resetSearch()
    {
        // $this->categories = Category::all();
        $this->pet_genders = '';
        $this->looking_fors = '';
        $this->pet_ages = '';
        $this->looking_for_states = '';
        $this->sizes = '';
        $this->pet_personalitys = '';
        $this->pet_sportss = '';
        $this->looking_for_locations = '';
        $this->names = '';
    }
    public function filterCategoryId($id)
    {

        return redirect()->route('f.filter', [
            'searchCategory' => $id,

        ]);
    }
    public function render()
    {
        $matchedPetIds = Pet::query()->where(function ($q) {
            if ($this->looking_for) {
                $q->where('category_id', $this->looking_for);
            }
            if ($this->pet_gender) {
                $q->orWhere('gender', $this->pet_gender);
            }
            if ($this->pet_age) {
                $q->orWhere('age', $this->pet_age);
            }
            if ($this->looking_for_state) {
                $q->orWhere('uk_state_id', $this->looking_for_state);
            }
            if ($this->size) {
                $q->orWhere('size', $this->size);
            }
            if ($this->pet_personality) {
                $q->orWhere('personality', $this->pet_personality);
            }
            if ($this->pet_sports) {
                $q->orWhere('sports', $this->pet_sports);
            }
            if ($this->looking_for_location) {
                $q->orWhere('location', $this->looking_for_location);
            }
        })->pluck('id'); // Get only 5 matched pet IDs

        // dd($matchedPetIds);
        // Step 2: Filter from these 5 results
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

        $matchedPets = $query->paginate(18);
        return view('livewire.search', [
            'pets' => $matchedPets,
            'categories' => $this->categories,
            'states' => UkState::get(),
            // 'breeds' => SubCategory::get(['id', 'slug', 'name', 'category_id']),
            // 'allBreeds' => SubCategory::where('status', 1)->get(['id', 'slug', 'name']),
            // 'recommanded' => Pet::where('status', 1)->get(['id', 'slug', 'name']),
        ]);
    }
}
