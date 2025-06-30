<?php

namespace App\Livewire;

use App\Models\BillingAddress;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Billing extends Component
{
    #[Title(' Billing')]


    public $countries;
    #[Validate('required')]
    public $country_id;
    #[Validate('required')]
    public $first_name;
    #[Validate('required')]
    public $last_name;

    public $company_name;
    #[Validate('required')]
    public $street_address1;
    public $street_address2;
    #[Validate('required')]
    public $city;
    #[Validate('required')]
    public $state;
    #[Validate('required')]
    public $post_code;
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $email;




    public function mount()
    {
        $this->countries = Country::all();
        $user = BillingAddress::where('user_id', Auth::user()->id)->first();


        $this->country_id = $user->country_id ?? '';
        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->company_name = $user->company_name ?? '';
        $this->street_address1 = $user->street_address1 ?? '';
        $this->street_address2 = $user->street_address2 ??'';
        $this->city = $user->city ?? '';
        $this->state = $user->state ??'';
        $this->post_code = $user->post_code ??'';
        $this->phone = $user->phone ?? '';
        $this->email = $user->email ??'';
    }


    public function updateBilling()
    {
        $this->validate();

        BillingAddress::updateOrCreate(
            [
                'user_id' => Auth::user()->id, // First array defines the search conditions
            ],
            [
                'country_id' => $this->country_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'company_name' => $this->company_name,
                'street_address1' => $this->street_address1,
                'street_address2' => $this->street_address2,
                'city' => $this->city,
                'state' => $this->state,
                'post_code' => $this->post_code,
                'phone' => $this->phone,
                'email' => $this->email,
            ]
        );
        flash()->success('Billing Address Updated successfully!');
    }

    public function render()
    {

        return view('livewire.billing');
    }
}
