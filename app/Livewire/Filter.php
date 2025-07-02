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
    public $sortBy = 'newest';
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

        return redirect()->route('f.filter');
        //     $this->selectedCategories = [];
        // $this->selectedBreeds = [];
        // $this->selectedLocations = [];
        //     $this->reset();
        //     $this->dispatch('clear-query-string');
        // return Redirect::to('/filter');
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
                $existingLike->delete();
                session()->flash('warning', 'You have already liked this pet.');
            }
        } else {
            return redirect()->route('f.login');
        }
    }

    public function mount()
    {
        $category = Request::get('searchCategory', '');
        $breed = Request::get('searchBreed', '');
        $this->state = Request::get('searchLocation', '');

        if (!empty($category)) {
            $this->selectedCategories = explode(',', $category);
        }

        if (!empty($breed)) {
            $this->selectedBreeds = explode(',', $breed);
        }
        if (!empty($state)) {
            $this->selectState = explode(',', state);
        }


        $this->categoires = Category::where('id', $this->selectedCategory)->first();
    }



    public function render()
    {


        $query = Pet::query()->where('isPublished', 1);

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
            $query->where('age', $this->age);
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

        // $query->orderBy(
        //     match ($this->sortBy) {
        //         'newest' => 'created_at',
        //         'oldest' => 'created_at',
        //         'lowest' => 'price',
        //         'highest' => 'price',
        //         default => 'created_at',
        //     },
        //     match ($this->sortBy) {
        //         'oldest', 'lowest' => 'asc',
        //         default => 'desc',
        //     }
        // );

        $orderColumn = $this->sortBy === 'lowest' || $this->sortBy === 'higest' ? 'price' : 'created_at';
        $orderDirection = $this->sortBy === 'oldest' || $this->sortBy === 'lowest' ? 'asc' : 'desc';

        $query->orderBy('is_featured', 'desc') // Always puts featured items first (1s before 0s)
            ->orderBy($orderColumn, $orderDirection)
            ->orderBy('position', 'asc', 'nulls_last')
            ->orderBy('id', 'desc');

        $ads = $query->withCount('images')->paginate(6);


        $spot = $query->withCount('images')->where('isPublished', 1)
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
            ->take(16)
            ->get();


        $excludedIds = $ads->pluck('id')->toArray();




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

            'categories' => Category::get(['id', 'slug', 'name']),
            'breeds' => $subCategories,
            'states' => UkState::get(['id', 'state']),
            'allBreeds' => SubCategory::where('status', 1)->get(['id', 'slug', 'name']),

        ]);
    }
}
