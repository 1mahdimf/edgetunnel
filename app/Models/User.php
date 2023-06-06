<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'login_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (User $model) {
            $model->uname = $model->generateUsername();
            $model->ip = request()->getClientIp();
        });
    }

    public function accountHasVerified()
    {
        return $this->hasVerifiedEmail() && $this->hasVerifiedPhone();
    }
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function getPhoneForVerification()
    {
        return $this->phone;
    }

    public function scopePhone($query, $phone){

        return $query->where('phone',$phone);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            set: fn ($value) => bcrypt($value),
        );
    }

    protected function generateUsername()
    {
        $uname = 'u' . mt_rand(1000000, 9999999);
        while (self::where('uname', $uname)->first()) {
            $uname =  'u' . mt_rand(1000000, 9999999);
        }
        return $uname;
    }
}
