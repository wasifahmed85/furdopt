<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Setting extends Component
{



    #[Title(' Setting')]

    public $email = '';
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
        $this->email = $this->user->email;
    }
    public function updateProfile()
    {

        $validated = $this->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'current_password' => [
                Rule::requiredIf(filled($this->password)),
                'current_password:web'
            ],
            'password' => [
                'nullable',
                'min:8',
                'confirmed'
            ]
        ]);

        $this->user->email = $validated['email'];

        if (filled($this->password)) {
            $this->user->password = Hash::make($validated['password']);
        }

        $this->user->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('success', 'Profile updated successfully.');
    }
    public function render()
    {
        return view('livewire.setting');
    }
}
