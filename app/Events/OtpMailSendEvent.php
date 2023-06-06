<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OtpMailSendEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $otp;
    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($otp, $request)
    {
        $this->otp = $otp->data->token;
        $this->email = $request->safe()->email;
    }
}
