<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Traits\LiveWire;


class Login extends Component
{

    use LiveWire;

    public  $phone, $password;
    public bool $remember = false;
    public $type = 'login';


    public function loginWithPass()
    {
        $this->validate()
        $this->validateCatch([
            'phone' => 'required|ir_mobile:zero|exists:users,phone',
            'password' => 'required',
        ]);

        if ($this->validateErrors) {
            return  $this->dispatchBrowserEvent('notice', ['type' => 'error', 'text' => $this->validateErrors]);
        }

        if (Auth()->attempt([$this->phone, $this->password], $this->remember)) {
            return $this->dispatchBrowserEvent('notice', ['type' => 'success', 'text' => 'ورود با موفقیت، در حال هدایت...']);
        }
        return $this->dispatchBrowserEvent('notice', ['type' => 'error', 'text' => 'شماره موبایل یا رمزعبور اشتباه است.']);
    }



    public function render()
    {
        if ($this->type == 'register') return   view('livewire.auth.register');

        return view('livewire.auth.login');
    }
}
