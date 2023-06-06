<?php

namespace App\Http\Requests\auth;

use App\Http\Requests\BaseRequest;

class LoginWithPassRequest extends BaseRequest
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
            'phone' => 'required|ir_mobile:zero|exists:users,phone',
            'password' => 'required',

        ];
    }
}
