<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->intended(route('home'));
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    public function steamLogin()
    {
        return redirect()->route('auth.steam');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

