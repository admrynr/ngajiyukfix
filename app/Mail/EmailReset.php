<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReset extends Mailable
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
        ->subject('Password Reset')
        ->view('mails.forgottemplate')
        ->with(
         [
            'name' => $this->var['name'],
            'link' => url('/reset', $this->var['id'])
         ]);
    }
}
