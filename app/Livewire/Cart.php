<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = ModelsCart::where('user_id', Auth::id())->get();
        $this->total = $this->cartItems->sum(fn($item) => $item->price * $item->quantity);
    }

    public function removeItem($itemId)
    {
        ModelsCart::findOrFail($itemId)->delete();
        $this->loadCart();
    }

    public function checkout()
    {
        // Redirect to payment
        return redirect()->route('checkout');
    }
    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
