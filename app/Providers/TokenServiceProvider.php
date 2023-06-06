<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Token;

class TokenServiceProvider extends ServiceProvider
{
 
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    //    $this->app->singleton('Otp', \App\Facades\OtpClass::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        Validator::extend('otp', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->safe()->all();
            $identifier =  $validator->safe()->has($parameters[0]) ? $inputData[$parameters[0]] : false;

            if ($identifier) {
                $otp = Token::Validate($identifier, $value);

                if (!$otp->success) {

                    $validator->errors()->add($attribute, $otp->msg);
                }
                return true;
            }
            return true;
        });



        $this->commands([
            \app\Console\Commands\CleanTokens::class,
        ]);
    }
}
