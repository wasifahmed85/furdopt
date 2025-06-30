<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentMethod extends Component
{
    #[Title(' Interest')]
     public $payments;
   
    public function render()
    {
        $this->payments = Payment::where('user_id',Auth::user()->id)->get();
        return view('livewire.payment-method');
    }
}
