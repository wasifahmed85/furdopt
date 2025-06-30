<?php

namespace App\Livewire;

use App\Jobs\TestJob;
use App\Models\Category;
use App\Models\Pet;
use App\Models\PetLike;
use App\Models\PetSoptlight;
use App\Models\UkState;
use App\Models\NewsletterSubscription;
use App\Models\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;

class Frontend extends Component
{
    #[Title(' Adopt or Rehome a pet in the UK')]
    #[Layout('components.layouts.frontend')]

    public $categories;
    public $breeds;
    public $cities;
    public $spots;






    public $categoryId;
    public $other = "Other";

    public $breedId = '';
    public $location = '';
    #[Validate('required|email')]
    public $email;
    public $success;

    #[On('breedSelected')]
    public function updatedBreed($value)
    {
        $this->breedId = $value;
    }

    protected $queryString = [
        'categoryId' => ['except' => ''],
        'breedId' => ['except' => ''],
        'location' => ['except' => ''],
    ];

    public function newSubcriber()
    {


        $check = NewsletterSubscription::where('email', $this->email)->first();
        if (empty($check)) {
            NewsletterSubscription::create(['email' => $this->email]);
            $this->success = 'Your Successfully Subscriberd For News Letter';
        } else {
            $this->success = 'This Email Already Subscriberd For News Letter';
        }
        $this->email = '';

    }


    // Method to handle category selection for Cats
    public function selectCategoryCat($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->other = Category::where('id', $categoryId)->first()->name;
        $this->dispatch('breedUpdated');
    }

    public function search()
    {


        if (!empty($this->categoryId) || !empty($this->breedId) || !empty($this->location)) {
            return redirect()->route('f.filter', [
                'searchCategory' => $this->categoryId,
                'searchBreed' => $this->breedId,
                'searchLocation' => $this->location,
            ]);
        } else {
            return redirect()->route('f.filter');
        }

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

                $existingLike = PetLike::where('pet_id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->delete();
                session()->flash('warning', 'You have already liked this pet.');
            }
        } else {

            return redirect()->route('f.login');
        }


    }

    public function render()
    {

        TestJob::dispatch();

        $query = Pet::query();

        $spots = $query->withCount('images')->where('isPublished', 1)
            ->whereHas('spotlight', function ($query) {
                $query->whereDate('end_date', '>=', now()); // Exclude expired spotlights
            })
            ->with([
                'spotlight' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
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

        $this->categories = Category::select(['id', 'slug', 'name'])->skip(2)->limit(30)->get();
        if ($this->categoryId) {
            $this->breeds = SubCategory::where('category_id', $this->categoryId)->get(['id', 'name']);
        } else {
            $this->breeds = SubCategory::get(['id', 'name']);
        }

        $this->cities = UkState::select(['id', 'state'])->get();
        $this->spots = Pet::where('isPublished', 1)->take(16)->get();
        //  $this->spots  = Pet::get();
        //  $this->spots  = $spots;

        return view('livewire.frontend');
    }
}
