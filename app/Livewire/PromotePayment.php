<?php

namespace App\Livewire;

use App\Models\Pet;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Locked;

#[Title('Promote Payment')]
class PromotePayment extends Component
{
    #[Locked]
    public $id;

    #[Locked]
    public $paymentAmount;

    public $petName;
    public $selectedPaymentMethod = null;
    public $message = '';

    public function mount($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $this->id = $decryptedId;
            $pet = Pet::find($decryptedId);
            if ($pet) {
                $this->petName = $pet->name;
                $this->paymentAmount = '5.99'; // Fixed amount for pet promotion
            } else {
                $this->petName = 'Unknown Pet';
                $this->paymentAmount = '0.00';
                $this->message = 'Error: Pet not found.';
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $this->petName = 'Invalid Pet';
            $this->paymentAmount = '0.00';
            $this->message = 'Error: Invalid pet ID provided or decryption failed.';
        }
    }

    public function selectPaymentMethod($method)
    {
        $this->selectedPaymentMethod = $method;
        $this->message = '';
    }

    public function payNow()
    {
        if ($this->selectedPaymentMethod) {
            return redirect()->route('f.promote.checkout', [
                'pet_id' => Crypt::encryptString($this->id),
                'payment_method' => $this->selectedPaymentMethod,
                'amount' => $this->paymentAmount,
            ]);
        } else {
            $this->message = "Please select a payment method before proceeding.";
        }
    }

    public function render()
    {
        return view('livewire.promote-payment');
    }
}
