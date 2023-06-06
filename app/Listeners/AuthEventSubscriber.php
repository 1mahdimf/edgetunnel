<?php
 
namespace App\Listeners;
 
use App\Events\LostPasswordEvent;
use App\Events\OtpMailSendEvent;
use App\Events\OtpSmsSendEvent;
use App\Notifications\OtpWithEmail;
use App\Notifications\OtpWithSms;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AuthEventSubscriber
{
 
    public function handleOtpMailSend($event) {
        Notification::route('mail', $event->email)->notify(new OtpWithEmail($event->email,$event->otp));
    }

    public function handleOtpSmsSend($event) {
     
        Notification::sendNow('', new OtpWithSms($event->phone,$event->otp));
    }

 

    public function subscribe($events)
    {
        return [
            OtpMailSendEvent::class => 'handleOtpMailSend',
            OtpSmsSendEvent::class => 'handleOtpSmsSend',
        ];
    }
}