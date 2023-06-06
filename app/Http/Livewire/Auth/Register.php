<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{

    public $fname, $lname, $phone, $email, $password, $password_confirmation;
    public $login = false;

    public function login()
    {
        $this->login = true;
    }
    public function render()
    {

        if ($this->login) return   view('livewire.auth.login');
        return view('livewire.auth.register');
    }
}
