<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\PetReport;
use App\Models\Checklist;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\PetLike;
use App\Models\Scam;
use App\Models\SubCategory;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;

    #[Title('Details')]
    #[Layout('components.layouts.frontend')]
    public $pet;
    public $scams;
    public $checklists;
    public $perPage = 6;
    public $allLoaded = false;
    public $userid;
    public $images;
    public $banner;
    public $ownerAdCount;
public $showShare = false;
 public $selected;

public $selectReport;
    public $showModal = false;
    public $details;
    public $message;
    public function openModal()
    {
        $this->selectReport = 1;
        $this->showModal = true;
        
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    
    

    public function toggleShare()
    {
        $this->showShare = !$this->showShare;
    }
    
    public function perReport()
    {
        PetReport::create([
            'pet_id' => $this->pet->id,
            'owner_id' => $this->pet->owner_id,
            'details' => $this->details,
            'user_id' => Auth::user()->id,
            
            ]);
        $this->details ='';
        $this->showModal = false;
        $this->message = 'Report Submited Successfully';
        
    }
    
    public function mount($slug)
    {
        $this->pet = Pet::withCount('likes')
            ->where('slug', $slug)
            ->first();
        

        if (!$this->pet) {
            abort(404, 'Pet not found.');
        }
        $pet = Pet::where('slug',$slug)->first();
                $pet->increment('views');
       
        $this->ownerAdCount = Pet::where('owner_id',$pet->owner_id)->count();
        $this->scams = Scam::all();
        // $this->checklists = Checklist::where('category_id', $this->pet->category_id)->get();
        $this->images = PetImage::where('pet_id', $this->pet->id)->get();
        $this->banner= Banner::where('category_id', $pet->category_id)->first();
    }

    public function petLikes($id)
    {
        if (auth()->check()) {
            $existingLike = PetLike::where('pet_id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$existingLike) {
                $pet = Pet::where('id',$id)->first();
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
            return redirect()->route('login');
        }
    }

    public function addToCart($petId, $promotionType, $price)
    {
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('pet_id', $petId)
            ->where('promotion_type', $promotionType)
            ->first();

        if (!$existingCartItem) {
            Cart::create([
                'user_id' => Auth::id(),
                'pet_id' => $petId,
                'promotion_type' => $promotionType,
                'price' => $price,
                'quantity' => 1,
            ]);

            session()->flash('success', 'Item added to cart!');
        } else {
            session()->flash('warning', 'This item is already in your cart.');
        }
    }


    public function loadMore()
    {
        $this->perPage += 6; // Increase the number of items to load
        $totalPets = Pet::where('category_id', $this->pet->category_id)
            ->where('id', '!=', $this->pet->id)
            ->count();

        // Check if all items are loaded
        if ($this->perPage >= $totalPets) {
            $this->allLoaded = true;
        }
    }

    public function search($id)
    {

        return redirect()->route('f.filter', [
            // 'searchCategory' => $this->categoryId,
            'searchBreed' => $id,
            // 'searchLocation' => $this->location,
        ]);
    }
    public function searchCategory($id)
    {

        return redirect()->route('f.filter', [
            'searchCategory' => $id,
            // 'searchBreed' => $id,
            // 'searchLocation' => $this->location,
        ]);
    }

    public function sendMessage($id)
    {

        return redirect()->route('f.chat', [
            'user' => $id,
        ]);
    }

    public function render()
    {
        $similarPets = Pet::with('breed')
            ->where('category_id', $this->pet->category_id)
            ->where('id', '!=', $this->pet->id)
            ->take($this->perPage)
            ->get();
        $allBreeds = SubCategory::where('status', 1)->get(['id', 'slug', 'name']);
        

        return view('livewire.detail', [
            'similarPets' => $similarPets,
            'allBreeds' => $allBreeds,
            
        ]);
    }
}
