<?php

namespace App\Livewire;

use App\Models\SubscriptionPlan;
use Livewire\Attributes\Title;
use Livewire\Component;

class Subscription extends Component
{
    #[Title(' Subscription')]

    public $plans;
    public $selectedPlan;


    public $showModal = false;
    public function openModal($id)
    {

        $this->showModal = true;
        $this->selectedPlan = SubscriptionPlan::findorfail($id);
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function render()
    {
        $this->plans = SubscriptionPlan::get();
        return view('livewire.subscription');
    }
}
