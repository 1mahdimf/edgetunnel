<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OtpSmsSendEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $otp;
    public $phone;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($otp , $request)
    {
        $this->otp = $otp->data->token;
        $this->phone = $request->safe()->phone;
      
    }

}
