<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $password = '';
    public $email = '';
    public $login = '';
    public function __construct($password, $email, $login)
    {
        $this->password = $password;
        $this->email = $email;
        $this->login = $login;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('backend.emails.adminemail',[
            'password' => $this->password,
            'email' => $this->email,
            'login' => $this->login
        ])->subject('your login password');
    }
}
