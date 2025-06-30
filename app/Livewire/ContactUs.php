<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Message;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ContactUs extends Component
{

    #[Title(' Contact Us')]
    #[Layout('components.layouts.frontend')]

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $subject;
    #[Validate('required')]
    public $message;

    public $success;


    public function save()
    {
        $this->validate();

        Message::create($this->all());

        $this->reset();
        $this->success = 'Message Successefully Submited';
    }

    public function render()
    {

        return view('livewire.contact-us');
    }
}
