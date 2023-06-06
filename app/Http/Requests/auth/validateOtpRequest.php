<?php

namespace App\Http\Requests\auth;

use App\Http\Requests\BaseRequest;

class validateOtpRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->check() && request()->wantsJson();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [

            'phone' => 'sometimes|required|ir_mobile:zero|exists:users,phone',
            'email' => 'sometimes|required|email|unique:users,email,' . auth()->user()->id,
            'otp' => 'required|digits:5',
            'otpType' => 'required|in:phone,email',
        ];

    
    }
}
