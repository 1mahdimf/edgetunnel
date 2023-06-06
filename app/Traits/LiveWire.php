<?php

namespace App\Traits;



trait  LiveWire
{

    public ?string $validateErrors;

    public function validateCatch($rules = null, $messages = [], $attributes = [])
    {


        try {
            return $this->validate($rules, $messages, $attributes);
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->all();
            $errors  = join("\n", $errors);
            $this->validateErrors = $errors;
        }

     

    }
}
