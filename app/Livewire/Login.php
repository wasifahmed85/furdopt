<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{

    public $email, $password, $remember = false;
    #[Title(' Login')]
      public bool $showPassword = false;
    
    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }
    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            Auth::user()->update(['active_status' => 0, 'last_login_at' => now()]);
            return redirect()->route('f.profile');
        }

        $this->addError('email', 'Invalid credentials. Please try again.');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.login');
    }
}
