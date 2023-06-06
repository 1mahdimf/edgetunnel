<?php

namespace App\Http\Controllers\auth;

use App\Events\OtpMailSendEvent;
use App\Events\OtpSmsSendEvent;
use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\SendOtpRequest;
use App\Http\Requests\auth\validateOtpRequest;
use App\Http\Requests\auth\VerifyAccountRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class VerifyAccountController extends Controller
{

    public function __construct()
    {
        
        $this->middleware(function ($request, $next) {
            if ($request->user()->accountHasVerified()) {
               return redirect(RouteServiceProvider::HOME);
           }
            return $next($request);
        });
       
       
    }



    public function index()
    {
        return view('auth.verifyaccount');
    }

    public function sendOtp(SendOtpRequest $request)
    {
        $input = $request->safe()->has('phone') ? auth()->user()->phone : $request->safe()->email;
        $otp = Token::generate($input, 5, 30);

        if (!$otp->success) {
            return response()->jsonError($otp->type, $otp->body, $otp->data);
        }

        OtpSmsSendEvent::dispatchIf($request->safe()->has('phone') && isset($otp->data->token), $otp, $request);
        OtpMailSendEvent::dispatchUnless($request->safe()->has('phone') && isset($otp->data->token), @$otp, $request);



        return response()->jsonSuccess($otp->type, 'کد ارسال شده را وارد کنید.', ['time' => $otp->data->time]);
    }

    public function validateOtp(validateOtpRequest $request)
    {

        $user = auth()->user();
        if ($request->safe()->otpType == "phone") {

            $otp = Token::Validate($user->phone, $request->safe()->otp);

            if (!$otp->success) {

                return response()->jsonError($otp->type, $otp->body);
            }
            $user->markPhoneAsVerified();
            return response()->jsonSuccess($otp->type, 'شماره موبایل با موفقیت تایید شد.', ["redirect" => $user->accountHasVerified()]);
        }
        if ($request->safe()->otpType == "email") {
            $email = $request->safe()->email;
            $otp = Token::Validate($email, $request->safe()->otp);

            if (!$otp->success) {

                return response()->jsonError($otp->type, $otp->body);
            }

            $user->markEmailAsVerified();
            $user->email = $email;
            $user->save();
            return response()->jsonSuccess($otp->type, 'ایمیل با موفقیت تایید شد.', ["redirect" => $user->accountHasVerified()]);
        }
    }
}
