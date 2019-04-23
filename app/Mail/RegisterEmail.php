<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $system_email,$settings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->system_email = Setting::where('field','system_email')->first()->value;
        $this->settings = Setting::all();
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailTemplate = Email::where('type','1')->first();

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%firstname%',$this->user->firstname,$emailContent);
        $emailContent = str_replace('%lastname%',$this->user->lastname,$emailContent);
        $emailContent = str_replace('%confirm%','<a href="'.route('register.confirm',array('token'=>$this->user->token)).'">'.route('register.confirm',array('token'=>$this->user->token)).'</a>',$emailContent);

        $this->from($this->system_email)
            ->subject('Please confirm your registration')
            ->view('public::mail.confirm')
            ->with([
                'emailContent' => $emailContent,
                'settings' => $this->settings
            ]);

        return $this;
    }
}
