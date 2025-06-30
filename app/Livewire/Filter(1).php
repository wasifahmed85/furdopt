<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\PetLike;
use App\Models\PetSoptlight;
use App\Models\Pet;
use App\Models\SubCategory;
use App\Models\UkState;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;

class Filter extends Component
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
    public $selectState;
    public $categoires;
    public $adType;

    public $weight;
    public $personality;
    public $size;
    public $colour;
    public $age;



    public $selectedBreed;
    public $selectedCategory;
    public $perPage = 5;
    public $hasMorePages = true;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $totalRecords = SubCategory::whereIn('category_id', $this->selectedCategories)->count();
        $this->perPage += 5;


        if ($this->perPage >= $totalRecords) {
            $this->hasMorePages = false;
        }


        $this->dispatch('$refresh');
    }

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
        'weight' => ['except' => 'weight'],
        'personality' => ['except' => 'personality'],
        'size' => ['except' => 'size'],
        'colour' => ['except' => 'colour'],
        'age' => ['except' => 'age'],
    ];

    public function clearAll()
    {
        $this->reset();
        $this->dispatch('clear-query-string');
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

    public function mount()
    {
        $this->selectedCategory = Request::get('searchCategory', '');
        $this->selectedBreed = Request::get('searchBreed', '');
        $this->locationSearch = Request::get('searchLocation', '');

        $this->categoires = Category::where('id', $this->selectedCategory)->first();
    }



    public function render()
    {


        $query = Pet::query();


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
        if ($this->selectState) {
            $query->where('uk_state_id', $this->selectState);
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
        if ($this->personality) {
            $query->where('personality', $this->personality);
        }
        if ($this->size) {
            $query->where('size', $this->size);
        }
        if ($this->colour) {
            $query->where('colour', $this->colour);
        }
        if ($this->age) {
            $query->where('colour', $this->age);
        }

        if ($this->weight) {

            $query->where('weight', 'like', '%' . $this->weight . '%');
        }

        if ($this->min_price || $this->max_price) {

            $query->whereBetween('price', [$this->min_price, $this->max_price]);
        }

        if ($this->gender) {
            // $query->where('gender', 'female');
            $query->whereIn('gender', $this->gender);
        }

        $query->orderBy(
            match ($this->sortBy) {
                'newest' => 'created_at',
                'oldest' => 'created_at',
                'lowest' => 'price',
                'highest' => 'price',
                default => 'created_at',
            },
            match ($this->sortBy) {
                'oldest', 'lowest' => 'asc',
                default => 'desc',
            }
        );

        $ads = $query->withCount('images')->paginate(6);
        // $spot = $query->withCount('images')->whereHas('spotlight')
        //     ->with(['spotlight' => function ($query) {
        //         $query->orderBy('created_at', 'desc');
        //     }])

        //     ->addSelect([
        //         'latest_spotlight_created_at' => PetSoptlight::select('created_at')
        //             ->whereColumn('pet_soptlights.pet_id', 'pets.id')
        //             ->latest()
        //             ->limit(1)
        //     ])
        //     ->orderByDesc('latest_spotlight_created_at')
        //     ->take(6)->get();

        $spot = $query->withCount('images')
            ->whereHas('spotlight', function ($query) {
                $query->whereDate('end_date', '>=', now()); // Exclude expired spotlights
            })
            ->with(['spotlight' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->addSelect([
                'latest_spotlight_created_at' => PetSoptlight::select('created_at')
                    ->whereColumn('pet_soptlights.pet_id', 'pets.id')
                    ->whereDate('end_date', '>=', now()) // Ensure it's not expired
                    ->latest()
                    ->limit(1)
            ])
            ->orderByDesc('latest_spotlight_created_at')
            ->take(6)
            ->get();


        $excludedIds = $ads->pluck('id')->toArray();

        // $rquery = Pet::query();

        // if (!empty($excludedIds)) {
        //     $rquery->whereNotIn('id', $excludedIds);
        // }

        // if (!empty($this->selectedCategory)) {
        //     // $rquery->whereNotIn('category_id', (array) $this->selectedCategory);
        //     $rquery->where('category_id', $this->selectedCategory); 
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
        // if (!empty($this->selectedBreeds)) {
        //     $rquery->where('sub_category_id', (array) $this->selectedBreeds);
        // }


        // $recomands = $rquery->latest()->take(6)->get();


        $allBreeds = SubCategory::where('status', 1)->get(['id', 'slug', 'name']);
        if ($this->categoires) {
            $subCategories = SubCategory::where('category_id', $this->categoires->id)
                ->orderBy('name', 'ASC')
                ->take($this->perPage)
                ->get();
        } else {
            $subCategories = SubCategory::whereIn('category_id', $this->selectedCategories)
                ->orderBy('name', 'ASC')
                ->take($this->perPage)
                ->get();
        }



        $totalRecords = SubCategory::whereIn('category_id', $this->selectedCategories)->count();
        $this->hasMorePages = $this->perPage < $totalRecords;

        return view('livewire.filter', [
            'ads' => $ads,
            'spotlights' =>  $spot,
            // 'recomandded' => $recomands,
            'categories' => Category::get(['id', 'slug', 'name']),
            'breeds' => $subCategories,
            'states' => UkState::get(['id', 'state']),
            'allBreeds' => SubCategory::where('status', 1)->get(['id', 'slug', 'name']),
            // 'recommanded' => Pet::where('status', 1)->get(['id', 'slug', 'name']),
        ]);
    }
}
