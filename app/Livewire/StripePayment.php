<?php

namespace App\Livewire;

use App\Models\Payment;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Charge;
use Stripe\Stripe;
use Livewire\Attributes\Title;

class StripePayment extends Component
{
    public $plan;
    public $amount;
    public $planId;
    #[Title(' Stripe Payment')]
    public function mount($slug)
    {
        $plan = SubscriptionPlan::where('slug', $slug)->first();
        $this->amount = $plan->price;
        $this->planId = $plan->id;
    }



    public function processPayment()
    {
        $this->validate(['amount' => 'required|numeric|min:1']);

        Stripe::setApiKey(config('stripe.stripe_sk'));

        try {
            $charge = Charge::create([
                'amount' => $this->amount * 100, // Stripe requires amount in cents
                'currency' => 'usd',
                'source' => request('stripeToken'),
                'description' => 'Pet Ad Subscription',
            ]);

            Payment::create([
                'user_id' => Auth::id(),
                'payment_gateway' => 'stripe',
                'transaction_id' => $charge->id,
                'subscription_plan_id' => $this->planId,
                'amount' => $this->amount,
                'payment_gateway' => 'Stripe',
                'status' => 'completed',
            ]);

            session()->flash('success', 'Payment successful!');
        } catch (\Exception $e) {
            session()->flash('error', 'Payment failed: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.stripe-payment');
    }
}
