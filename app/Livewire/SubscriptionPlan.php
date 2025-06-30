<?php

namespace App\Livewire;

use App\Models\SubscriptionPlan as ModelsSubscriptionPlan;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Charge;
use Stripe\Stripe;
use Livewire\Attributes\Title;

class SubscriptionPlan extends Component
{

    public $subscriptionsplans;
    #[Title(' Subscription Plan')]
    public function processPayment($id)
    {

        $plan = ModelsSubscriptionPlan::findorfail($id);

        Stripe::setApiKey(config('stripe.stripe_sk'));

        try {
            $charge = Charge::create([
                'amount' => $plan->price * 100, // Stripe requires amount in cents
                'currency' => 'usd',
                'source' => request('stripeToken'),
                'description' => 'Pet Ad Subscription',
            ]);

            Payment::create([
                'user_id' => Auth::id(),
                'payment_gateway' => 'stripe',
                'transaction_id' => $charge->id,
                'subscription_plan_id' => $plan->id,
                'amount' => $plan->price,
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
        $this->subscriptionsplans = ModelsSubscriptionPlan::where('status', 1)->get(['id', 'slug', 'name']);
        return view('livewire.subscription-plan');
    }
}
