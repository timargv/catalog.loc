<?php

namespace App\Mail\Auth;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use SerializesModels;

    // Создание публичной переменно $user
    public $user;

    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    public function build()
    {
        return $this
//            ->from('timur.rgv@mail.ru', 'Bryce Andy')
            ->subject(__('register.VerificationRegister'))
            ->markdown('emails.auth.register.verify');
    }
}
