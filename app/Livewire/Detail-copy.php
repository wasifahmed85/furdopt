<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Pet;
use App\Models\PetLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;
    #[Title(' Details')]
    #[Layout('components.layouts.frontend')]
    public $pet;
    public $similarPets;
    public function mount($slug)
    {

        Pet::where('slug', $slug)->increment('views');
        $this->pet = Pet::withCount('likes')->where('slug', $slug)->first();
        // $this->similarPets = Pet::where('category_id', $this->pet->category_id)->where('id', '!=', $this->pet->id)->paginate(6);
        $this->similarPets = Pet::with('breed') // Replace with your actual relationship
            ->where('category_id', $this->pet->category_id)
            ->where('id', '!=', $this->pet->id)
            ->paginate(6);
    }

    public function petLikes($id)
    {

        if (auth()->check()) {
            Pet::where('id', $id)->increment('likes');
            PetLike::create([
                'pet_id' => $id,
                'user_id' => auth()->user()->id,
            ]);
            session()->flash('success', 'Wow! you likes this Pet');
        } else {
            return redirect()->route('login');
        }
    }

    public function addToCart($petId, $promotionType, $price)
    {

        Cart::create([
            'user_id' => Auth::id(),
            'pet_id' => $petId,
            'promotion_type' => $promotionType,
            'price' => $price,
            'quantity' => 1,
        ]);

        session()->flash('success', 'Item added to cart!');
    }
    public function render()
    {
        return view('livewire.detail');
    }
}
