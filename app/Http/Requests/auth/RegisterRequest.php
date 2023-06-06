<?php

namespace App\Http\Requests\auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->wantsJson();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'fname' => 'required|persian_alpha|min:3',
            'lname' => 'required|min:3|persian_alpha',
            'phone' => 'required|ir_mobile:zero|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:7|confirmed',
            

        ];
    }
}
