<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.temporaryRegistration')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject('仮登録が完了しました')
            ->with([
                'expiration_date' => $this->registration->expiration_date,
                'token' => $this->registration->token
            ]);
    }
}
