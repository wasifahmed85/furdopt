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

class FrontendMatch extends Component
{
    use WithPagination;

    #[Title('Match')]
    #[Layout('components.layouts.app')]

    public $colour;
     public $weight;
    public $price_from;
    public $price_to;
    
    public $search = '';
    public $pet_gender, $looking_for, $pet_age, $looking_for_state, $size, $pet_personality, $pet_sports, $looking_for_location, $name,$looking_for_breed;
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
            $this->looking_for_breed = $user->looking_for_breed;
        }

        $this->pet_genders = Request::get('pet_genders', '');
        $this->looking_fors = Request::get('looking_fors', '');
        $this->pet_ages = Request::get('pet_ages', '');
        $this->looking_for_states = Request::get('looking_for_states', '');
        $this->sizes = Request::get('sizes', '');
        $this->pet_personalitys = Request::get('pet_personalitys', '');
        $this->pet_sportss = Request::get('pet_sportss', '');
        $this->looking_for_locations = Request::get('looking_for_locations', '');
        $this->looking_for_breeds = Request::get('looking_for_breeds', '');
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
        
$this->weight = '';
        $this->price_from = '';
        $this->price_to = '';
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
        $this->colour = $this->colour;
    }

    public function render()
    {


        $matchedPetIds = Pet::query()
        
        ->where('category_id',$this->looking_for)
       ->when($this->looking_for_breed, function ($q) {
        $q->where('sub_category_id', $this->looking_for_breed); 
    })
        
        ->where(function ($q) {
            if ($this->looking_for) {
                $q->where('category_id', $this->looking_for);
            }
            if ($this->pet_gender) {
                $q->orWhere('gender', $this->pet_gender);
            }
            if ($this->pet_age) {
                $q->orWhere('age', $this->pet_age);
            }
            if ($this->colour) {
                $q->orWhere('colour', $this->colour);
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
            // if ($this->looking_for_breed) {
            //     $q->orWhere('sub_category_id', $this->looking_for_breed);
            // }
        })->pluck('id');


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
        if ($this->colour) {
            $query->where('colour', $this->colour);
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
        if (!empty($this->colour)) {
            $query->where('colour', $this->colour);
        }
        
    $this->weight = $this->weight;
        $this->price_from =$this->price_from;
        $this->price_to = $this->price_to;

        if (!empty($this->weight)) {
            $query->where('weight', $this->weight);
        }
        if (!empty($this->price_from) && !empty($this->price_to)) {
    $query->whereBetween('price', [$this->price_from, $this->price_to]);
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
            $query->where('location', 'LIKE', '%' . $this->looking_for_locations . '%');
        }

        $matchedPets = $query->where('isPublished',1)->paginate(16);




        return view('livewire.frontend-match', [
            // 'matchedPets2' => $matchedPets2,
            'matchedPets' => $matchedPets,
            'categoreis' => Category::where('status', 1)->get(),
            'states' => UkState::get(),
        ]);
    }



    // public function render()
    // {
    //     $filters = [
    //         'category_id' => $this->looking_for,
    //         'gender' => $this->pet_gender,
    //         'age' => $this->pet_age,
    //         'uk_state_id' => $this->looking_for_state,
    //         'size' => $this->size,
    //         'personality' => $this->pet_personality,
    //         'sports' => $this->pet_sports,
    //         'location' => $this->looking_for_location
    //     ];

    //     $totalCriteria = count(array_filter($filters)); // Count non-empty filters

    //     $matchedPets = Pet::all()->map(function ($pet) use ($filters, $totalCriteria) {
    //         $matchedCount = 0;

    //         foreach ($filters as $key => $value) {
    //             if (!empty($value) && $pet->$key == $value) {
    //                 $matchedCount++;
    //             }
    //         }

    //         // Define match percentage based on matched filters
    //         $matchPercentages = [
    //             7 => 100,
    //             6 => 95,
    //             5 => 90,
    //             4 => 85,
    //             3 => 80,
    //             2 => 75,
    //             1 => 70
    //         ];

    //         $pet->match_percentage = $matchPercentages[$matchedCount] ?? 0;
    //         return $pet;
    //     });

    //     // Remove pets with 0% match
    //     $matchedPets = $matchedPets->filter(fn($pet) => $pet->match_percentage > 0);

    //     // Sort by match percentage (highest first)
    //     $matchedPets = $matchedPets->sortByDesc('match_percentage')->values();

    //     // Paginate manually
    //     $page = request()->get('page', 1);
    //     $perPage = 18;
    //     $pagedData = $matchedPets->slice(($page - 1) * $perPage, $perPage);

    //     return view('livewire.frontend-match', [
    //         'matchedPets' => new \Illuminate\Pagination\LengthAwarePaginator(
    //             $pagedData,
    //             $matchedPets->count(),
    //             $perPage,
    //             $page
    //         ),
    //         'categoreis' => Category::where('status', 1)->get(),
    //         'states' => UkState::get(),
    //     ]);
    // }

}
