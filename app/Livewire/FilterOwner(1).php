<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\PetSoptlight;
use App\Models\Pet;
use App\Models\PetLike;
use App\Models\UkState;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;

class FilterOwner extends Component
{
    use WithPagination;
    #[Title(' My Pawrent')]
    #[Layout('components.layouts.frontend')]

    public $category;
    public $selectedCategories = [];
    public $selectedBreeds = [];
    public $search = '';
    public $min_price = 0;
    public $max_price = 10000;
    public $sortBy;
    public $location;
    public $gender = [];
    public $genderFemale;
    public $genderMale;
    public $genderMixed;
    public $breedName;
    public $categoryName;
    public $locationSearch;
    public $verifiedBreeders;
    public $adType;

    public $selectedBreed;
    public $selectedCategory;
    public $ownerId;


    protected $queryString = [
        'adType' => ['except' => ''],
        'search' => ['except' => ''],
        'categoryName' => ['except' => ''],
        'breedName' => ['except' => ''],
        'verifiedBreeders' => ['except' => ''],
        'selectedCategories' => ['except' => ''],
        'selectedBreeds' => ['except' => ''],
        'gender' => ['except' => ''],
        'breed' => ['except' => ''],
        'keyword' => ['except' => ''],
        'min_price' => ['except' => ''],
        'max_price' => ['except' => ''],
        'distance' => ['except' => 'Nationwide'],
        'genderFemale' => ['except' => ''],
        'genderMale' => ['except' => ''],
        'genderMixed' => ['except' => ''],
        'locationSearch' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
    ];

    public function clearAll()
    {
        $this->reset();
        $this->dispatch('clear-query-string');
        // $this->resetQueryString();
        // return $this->redirect('/filter');
        // return redirect()->route('f.filter');
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

                session()->flash('success', 'Wow! You liked this pet.');
            } else {
                session()->flash('warning', 'You have already liked this pet.');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function mount($id)
    {
        $this->ownerId = $id;
    }

    public function SelectedBreed($id)
    {


        $this->selectedBreeds = [$id];
    }

    public function render()
    {
        if (!empty($this->selectedCategories)) {
            $this->dispatch('clear-query-string');
        }

        $query = Pet::query();

        // Apply Filters
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }
        if ($this->selectedBreed) {
            $query->where('sub_category_id', $this->selectedBreed);
        }
        if ($this->category) {
            $query->where('category_id', $this->category);
        }
        if ($this->selectedCategories) {
            $query->whereIn('category_id', $this->selectedCategories);
        }
        if ($this->selectedBreeds) {
            $query->whereIn('sub_category_id', $this->selectedBreeds);
        }
        if ($this->adType) {
            $query->where('ad_type', $this->adType);
        }
        if ($this->categoryName) {
            $query->whereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->categoryName . '%');
            });
        }
        if ($this->breedName) {
            $query->whereHas('breed', function ($q) {
                $q->where('name', 'like', '%' . $this->breedName . '%');
            });
        }
        if ($this->verifiedBreeders) {
            $query->whereHas('userd', function ($q) {
                $q->where('verify_breeder_status', 1);
            });
        }
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if ($this->location) {
            $query->where('location', $this->location);
        }
        if ($this->locationSearch) {

            $query->where('location', 'like', '%' . $this->locationSearch . '%');
        }

        if ($this->min_price || $this->max_price) {

            $query->whereBetween('price', [$this->min_price, $this->max_price]);
        }

        if ($this->gender) {
            // $query->where('gender', 'female');
            $query->whereIn('gender', $this->gender);
        }
        // if ($this->genderMale) {
        //     $query->where('gender', 'male');
        // }
        // if ($this->genderMixed) {
        //     $query->where('gender', 'other');
        // }
        // Sort
        // if ($this->sortBy === 'newest') {
        //     $query->orderBy('created_at', 'desc');
        // } elseif ($this->sortBy === 'oldest') {

        //     $query->orderBy('created_at', 'asc');
        // } elseif ($this->sortBy === 'lowest') {
        //     $query->orderBy('price', 'asc');
        // } elseif ($this->sortBy === 'higest') {
        //     $query->orderBy('price', 'desc');
        // }
        $query->orderBy(
            match ($this->sortBy) {
                'newest' => 'created_at',
                'oldest' => 'created_at',
                'lowest' => 'price',
                'highest' => 'price', // Fixed typo
                default => 'created_at', // Default sorting
            },
            match ($this->sortBy) {
                'oldest', 'lowest' => 'asc',
                default => 'desc',
            }
        );

        $ads = $query->where('owner_id', $this->ownerId)->paginate(6);
        $spot = $query->whereHas('spotlight')
            ->with(['spotlight' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->orderByDesc(
                PetSoptlight::select('created_at')
                    ->whereColumn('pet_soptlights.pet_id', 'pets.id')
                    ->latest()
                    ->take(1)
            )
            ->take(6)->get();

        // Get the IDs of pets from the search result
        $excludedIds = $ads->pluck('id')->toArray();

        // $rquery = Pet::query();


        // if (!empty($excludedIds)) {
        //     $rquery->whereNotIn('id', $excludedIds);
        // }


        // if (!empty($this->selectedCategory)) {

        //     $rquery->where('category_id', (array) $this->selectedCategory);
        // }
        // if (!empty($this->selectedBreed)) {

        //     $rquery->where('sub_category_id', (array) $this->selectedBreed);
        // }
        // if (!empty($this->category)) {
        //     $rquery->where('category_id', $this->category);
        // }
        // if (!empty($this->selectedCategories)) {
        //     $rquery->where('category_id', (array) $this->selectedCategories);
        // }
        // if (!empty($this->selectedBreeds)) {
        //     $rquery->where('sub_category_id', (array) $this->selectedBreeds);
        // }


        // $recomands = $rquery->latest()->take(6)->get();


        $allBreeds = SubCategory::where('status', 1)->get(['id', 'slug', 'name']);
        return view('livewire.filter-owner', [
            'ads' => $ads,
            'spotlights' =>  $spot,
            // 'recomandded' => $recomands,
            'states' => UkState::get(['id', 'state']),
            'categories' => Category::get(['id', 'slug', 'name']),
            'breeds' => SubCategory::get(['id', 'slug', 'name', 'category_id']),
            'allBreeds' => SubCategory::where('status', 1)->get(['id', 'slug', 'name']),
            // 'recommanded' => Pet::where('status', 1)->get(['id', 'slug', 'name']),
        ]);
    }
}
