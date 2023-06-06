<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Token extends Model
{
      /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'token', 'validity','valid'
    ];

/**
     * @param string $identifier
     * @param int $digits
     * @param int $validity
     * @return mixed
     */
    public static function generate(string $identifier, int $digits = 4, int $validity = 3): object
    {
        $otp =  static::where('identifier', $identifier)->where('valid', true)->first();

        $now = Carbon::now()->timestamp;


        if (!empty($otp)) {
            $validityAccess = $otp->updated_at->addMinutes($otp->validity)->timestamp;
            if ($validityAccess > $now) {
                $mSeconds = ($validityAccess - $now) * 1000;
                return  response()->success('otpSentLimit', 'کد ایجاد شده را وارد کنید.', ['time' => $mSeconds]);
            }
        } 


            $token = str_pad(self::generatePin(), 4, '0', STR_PAD_LEFT);

            if ($digits == 5)
                $token = str_pad(self::generatePin(5), 5, '0', STR_PAD_LEFT);

            if ($digits == 6)
                $token = str_pad(self::generatePin(6), 6, '0', STR_PAD_LEFT);

            $otpToken = sha1($token);

            static::updateOrCreate(['identifier' => $identifier],[
                'identifier' => $identifier,
                'token' => $otpToken,
                'validity' => $validity,
                'valid' => true
            ]);
            $mSeconds = $validity * 60 * 1000;
            return  response()->success('otpCreated', 'کد ایجاد شد.', ['token' => $token, 'time' => $mSeconds]);
       
    }

    /**
     * @param string $identifier
     * @param string $token
     * @return mixed
     */
    public static function validate(string $identifier, string $token): object
    {
        $otpToken = sha1($token);
        $otp = static::where('identifier', $identifier)->where('token',  $otpToken)->first();

        if ($otp == null) {
            return  response()->error('OtpNotExist', 'کد رو درست وارد می‌کنی؟');
        } else {
            if ($otp->valid == true) {

                $now =  Carbon::now()->timestamp;
                $validity = $otp->updated_at->addMinutes($otp->validity)->timestamp;
                if ($validity < $now) {
                    $otp->timestamps = false;
                    $otp->valid = false;
                    $otp->save();
                    return  response()->error('OtpExpired', 'کد ارسالی معتبر نیست.');
                } else {
                    $otp->valid = false;
                    $otp->timestamps = false;
                    $otp->save();
                    return  response()->success('OtpValid', 'کد ارسالی معتبر است.');
                }
            } else {
                return  response()->error('OtpNotValid', 'کد ارسالی معتبر نیست.');
            }
        }
    }

    public static function Remove(string $identifier){
        static::where('identifier', $identifier)->delete();
    }

    /**
     * @param int $digits
     * @return string
     */
    private static function generatePin($digits = 4)
    {
        $i = 0;
        $pin = "";

        while ($i < $digits) {
            $pin .= random_int(0, 9);
            $i++;
        }

        return $pin;
    }



}
