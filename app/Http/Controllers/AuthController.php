<?php

namespace App\Http\Controllers;


use App\Events\OtpSmsSendEvent;
use App\Http\Requests\auth\LoginWithPassRequest;
use App\Http\Requests\auth\LostPasswordRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Token;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginWithPass(LoginWithPassRequest $request)
    {

        if (Auth()->attempt($request->safe(['phone', 'password']), $request->boolean('remember'))) {
            return response()->jsonSuccess('login', 'ورود با موفقیت، در حال هدایت...', ['url' => url()->previous()]);
        }

        return response()->jsonError('login', 'شماره موبایل یا رمزعبور اشتباه است.');
    }
    public function register(RegisterRequest $request)
    {

        $user = User::create($request->safe()->toArray());
        if (empty($user->id)) {
            return response()->jsonError('userDontCreate', 'خطایی رخ داد!!', ['url' => url()->previous()]);
        }

        auth()->login($user);
        return response()->jsonSuccess('userCreated', 'ثبت‌ نام با موفقیت، در حال هدایت...', ['url' => url()->previous()]);
    }

    public function lostPassword(LostPasswordRequest $request)
    {
        if($request->safe()->formType == 'lostPassword'){
            $otp = Token::generate($request->safe()->phone, 5, 30);
          
            if (!$otp->success) {
                return response()->jsonError($otp->type, $otp->body);
            }

            OtpSmsSendEvent::dispatchIf(isset($otp->data->token),@$otp->data->token ,$request->safe()->phone );

            return response()->jsonSuccess($otp->type, 'کد ارسال شده را وارد کنید.', ['time'=>$otp->data->time]);
    
        }

      
        
        $otpValidate = Token::Validate($request->safe()->phone, $request->safe()->otp);

        if (!$otpValidate->success) {

            return response()->jsonError($otpValidate->type, $otpValidate->body);
        }
       $user = User::phone($request->safe()->phone)->first();
       $user->update(['password'=>$request->safe()->password]);
   
       return response()->jsonSuccess('passwordChanged', 'رمز عبور با موفقیت تغییر یافت.');


     }


    
    public function logOut()
    {
      
        session()->flush();
        auth()->logout();

        return redirect()->intended()->with('notify',['success', 'با موفقیت از حساب کاربری خارج شدید، منتظر شما هستیم.']);
    }
}
