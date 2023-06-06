<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class BaseRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    protected  function failedValidation(Validator $validator)
    {

        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->jsonError('error',Arr::join($validator->errors()->all(),"<br>")));
        }
         
                parent::failedValidation($validator);
        
        // return redirect()->back()->with('msg', 'error|' . Response::validatorError($validator))
        //     ->withErrors($validator);
            
    }
  

 
}
