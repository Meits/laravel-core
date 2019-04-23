<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    private $contactMessage;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
        $this->subject = Setting::where('field','contact_subject')->first()->value;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $emailTemplate = Email::where('type','3')->first();
        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%firstname%',$this->contactMessage->firstname,$emailContent);
        $emailContent = str_replace('%lastname%',$this->contactMessage->lastname,$emailContent);
        $emailContent = str_replace('%email%',$this->contactMessage->email,$emailContent);
        $emailContent = str_replace('%phone%',$this->contactMessage->phone,$emailContent);
        $emailContent = str_replace('%text%',$this->contactMessage->text,$emailContent);

        $this
            ->subject($this->subject)
            ->view('public::mail.common-content')
            ->with([
                'emailContent' => $emailContent
            ]);

        return $this;
    }
}
