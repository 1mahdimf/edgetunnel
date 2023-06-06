<?php

namespace App\Http\Requests\auth;

use App\Http\Requests\BaseRequest;

class LostPasswordRequest extends BaseRequest
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
        $rules =  [

            'formType' => 'required|in:login,register,lostPassword,lostPasswordStep2',
            'phone' => 'required|ir_mobile:zero|exists:users,phone',

        ];

        if ($this->formType == 'lostPasswordStep2') {

            $rules['otp'] = 'required|digits:5';
            $rules['password'] = 'required|min:7|confirmed';
        }

        return $rules;
    }
}
