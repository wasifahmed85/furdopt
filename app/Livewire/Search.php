<?php

namespace App\Livewire;

use App\Models\Pet;
use App\Models\PetLike;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use App\Models\UserDetail;
use App\Models\UkState;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    #[Title(' Search')]


    public $search = '';
    public $categories;
    public $colour;
    public $weight;
    public $price_from;
    public $price_to;
    public $pet_gender, $looking_for, $pet_age, $looking_for_state, $size, $pet_personality, $pet_sports, $looking_for_location, $name;
    public $pet_genders, $looking_fors, $pet_ages, $looking_for_states, $sizes, $pet_personalitys, $pet_sportss, $looking_for_locations, $names;
    public $pet_genderf, $looking_forf, $pet_agesf, $looking_for_statesf, $sizesf, $pet_personalitysf, $pet_sportssf, $looking_for_locationsf, $namesf;

    public function mount()
    {
        // $user = UserDetail::where('user_id', Auth::id())->first();

        // if ($user) {
        //     $this->pet_gender = $user->pet_gender;
        //     $this->looking_for = $user->looking_for;
        //     $this->pet_age = $user->pet_age;
        //     $this->looking_for_state = $user->looking_for_state;
        //     $this->size = $user->size;
        //     $this->pet_personality = $user->pet_personality;
        //     $this->pet_sports = $user->pet_sports;
        //     $this->looking_for_location = $user->looking_for_location;
        // }

        $this->categories = Category::all();
    }

    public function petLikes($id)
    {

        if (auth()->check()) {
            $existingLike = PetLike::where('pet_id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$existingLike) {
                $pet = Pet::where('id', $id)->first();
                $pet->increment('like');
                PetLike::create([
                    'pet_id' => $id,
                    'owner_id' => $pet->owner_id,
                    'user_id' => auth()->user()->id,
                ]);
                $this->mount();
                session()->flash('success', 'Wow! You liked this pet.');
            } else {
                $existingLike->delete();
                session()->flash('warning', 'You have already liked this pet.');
            }
        } else {
            return redirect()->route('login');
        }

        $this->mount();
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
        $this->name = '';
        $this->pet_gendersf = '';
        $this->looking_forsf = '';
        $this->pet_agesf = '';
        $this->looking_for_statesf = '';
        $this->sizesf = '';
        $this->pet_personalitysf = '';
        $this->pet_sportssf = '';
        $this->looking_for_locationsf = '';
        $this->namesf = '';
        $this->colour = '';
        $this->weight = '';
        $this->price_from = '';
        $this->price_to = '';
    }

    public function filterCategoryId($id)
    {

        $this->looking_fors = $id;
        // return redirect()->route('f.filter', [
        //     'searchCategory' => $id,

        // ]);
    }

    public function searchMatch()
    {

        $this->pet_genderf = $this->pet_genders;
        $this->looking_forf = $this->looking_fors;
        $this->pet_agesf = $this->pet_ages;
        $this->looking_for_statesf = $this->looking_for_states;
        $this->sizesf = $this->sizes;
        $this->pet_personalitysf = $this->pet_personalitys;
        $this->pet_sportssf = $this->pet_sportss;
        $this->looking_for_locationsf = $this->looking_for_locations;
        $this->colour = $this->colour;
        $this->weight = $this->weight;
        $this->price_from = $this->price_from;
        $this->price_to = $this->price_to;
    }

    public function render()
    {

        // Step 1: Get initially matched pets
        // $matchedPetIds = Pet::query()->where(function ($q) {
        //     if ($this->looking_for) {
        //         $q->where('category_id', $this->looking_for);
        //     }
        //     if ($this->pet_gender) {
        //         $q->orWhere('gender', $this->pet_gender);
        //     }
        //     if ($this->pet_age) {
        //         $q->orWhere('age', $this->pet_age);
        //     }
        //     if ($this->looking_for_state) {
        //         $q->orWhere('uk_state_id', $this->looking_for_state);
        //     }
        //     if ($this->size) {
        //         $q->orWhere('size', $this->size);
        //     }
        //     if ($this->pet_personality) {
        //         $q->orWhere('personality', $this->pet_personality);
        //     }
        //     if ($this->pet_sports) {
        //         $q->orWhere('sports', $this->pet_sports);
        //     }
        //     if ($this->looking_for_location) {
        //         $q->orWhere('location', $this->looking_for_location);
        //     }
        // })->pluck('id'); // Get only 5 matched pet IDs

        // dd($matchedPetIds);
        // Step 2: Filter from these 5 results
        $query = Pet::query();

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
        if ($this->colour) {
            $query->where('colour', $this->colour);
        }
        if ($this->weight) {
            $query->where('weight', $this->weight);
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
        if ($this->name) {
            $query->where('name', 'LIKE', "%{$this->name}%");
        }

        //filter 

        // search
        //         if (!empty($this->looking_forsf)) {
        //             $query->where('category_id', $this->looking_forsf);
        //         }
        //         if (!empty($this->pet_gendersf)) {
        //             $query->where('gender', $this->pet_gendersf);
        //         }
        //         if (!empty($this->pet_ages)) {
        //             $query->where('age', $this->pet_ages);
        //         }
        //         if (!empty($this->weight)) {
        //             $query->where('weight', $this->weight);
        //         }
        //         if (!empty($this->price_from) && !empty($this->price_to)) {
        //     $query->whereBetween('price', [$this->price_from, $this->price_to]);
        // }
        //         if (!empty($this->looking_for_statesf)) {
        //             $query->where('uk_state_id', $this->looking_for_statesf);
        //         }
        //         if (!empty($this->sizesf)) {
        //             $query->where('size', $this->sizesf);
        //         }
        //         if (!empty($this->pet_personalitysf)) {
        //             $query->where('personality', $this->pet_personalitysf);
        //         }
        //         if (!empty($this->pet_sportssf)) {
        //             $query->where('sports', $this->pet_sportssf);
        //         }

        //         if (!empty($this->looking_for_locations)) {
        //             $query->where('location', 'LIKE', '%' . $this->looking_for_locations . '%');
        //         }

        // Step 3: Paginate filtered results (from the initial 5)
        $matchedPets = $query->where('isPublished', 1)
            ->orderBy('is_featured', 'desc')
            ->orderBy('position', 'asc', 'nulls_last')
            ->orderBy('id', 'desc')
            ->paginate(16);
        // $matchedPets2 = $query->paginate(6);


        return view('livewire.search', [
            'searchpets' => $matchedPets,
            'categories' => $this->categories,
            'states' => UkState::get(),
            // 'breeds' => SubCategory::get(['id', 'slug', 'name', 'category_id']),
            // 'allBreeds' => SubCategory::where('status', 1)->get(['id', 'slug', 'name']),
            // 'recommanded' => Pet::where('status', 1)->get(['id', 'slug', 'name']),
        ])->layout('components.layouts.app');;
    }
}
