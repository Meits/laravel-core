<?php

namespace App\Notifications;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    private $token;
    private $system_email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->system_email = Setting::where('field','system_email')->first()->value;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $emailTemplate = Email::where('type','2')->first();

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%reset%',"<a href='".url('password/reset', $this->token)."'>Link</a>",$emailContent);
        $emailContent = str_replace('%name%',$notifiable->firstname,$emailContent);

        return (new MailMessage)
            ->view('public::mail.common-content',
                [
                'token' => $this->token,
                'emailContent' => $emailContent
                ]
            )
            ->from($this->system_email)
            ->subject('Password Reset');

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
            //
        ];
    }
}
