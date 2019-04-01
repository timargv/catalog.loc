<?php

namespace App\UseCases\Auth;


use App\UseCases\Cart\CartService;
use App\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;

class RegisterService
{

    private $mailer;
    private $dispatcher;
    private $cartService;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher, CartService $cartService)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
        $this->cartService = $cartService;
    }

    public function register(RegisterRequest $request)
    {

        $user = User::register(
            $request['name'],
            $request['last_name'],
            $request['email'],
            $request['password']
        );

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->verify();
    }
}