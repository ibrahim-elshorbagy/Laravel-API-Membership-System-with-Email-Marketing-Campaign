<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Change Password Request')
            ->line('We received a request to reset your password.')
            ->line('If you did not make this request, please ignore this email.')
            ->line('Here is your reset code:')
            ->line('**' . $this->token . '**')
            ->line('Enter this code on the reset password page to complete the process.')
            ->line('Thank you for using our application!');
    }

}
