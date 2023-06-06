<?php

namespace App\Notifications;

use App\Channels\Sms\IppanelMessage;
use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OtpWithSms extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phone,$otp)
    {
      $this->phone = $phone;
      $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSms()
    {
      
        return (new IppanelMessage)
                    ->to($this->phone)
                    ->patternCode('4xhhim1rlj')
                    ->patternValue(['code' => (string) $this->otp]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
           'hi'=>'asdasd',
        ];
    }
}
