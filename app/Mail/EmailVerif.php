<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class EmailVerif extends Mailable
{
    use Queueable, SerializesModels;
    public $var;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($var)
    {
        $this->var = $var;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->from('bliomi@test.com', 'Bliomi')
                        ->subject('Email Confirmation')
                        ->view('mails.mailtemplate')
                        ->with(
                         [
                             'name' => $this->var['name'],
                             'link' => url('/verified', $this->var['id'])
                         ]);
    }
}
