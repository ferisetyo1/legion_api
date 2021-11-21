<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($users=[])
    {
        $this->user=$users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('feri.demoz001@gmail.com', 'Admin Legion')
            ->subject('Request Reset Password')
            ->markdown('mail.reset-password')
            ->with([
                'url_reset'=>$this->user['url_reset']
            ]);
    }
}
