<?php

namespace App\Http\Controllers\Auth;

use App\Entity\Shop\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\UseCases\Cart\CartService;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class LoginController extends Controller
{
    use ThrottlesLogins;

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('guest')->except('logout');
        $this->cartService = $cartService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['email', 'password']),
            $request->filled('remember')
        );

        if ($authenticate) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $user = Auth::user();
            if ($user->isWait()) {
                Auth::logout();
                return back()->with('error', 'Вам необходимо подтвердить свою учетную запись. Пожалуйста, проверьте свой email.');
            }

            $items = session()->get('cart');
            if ($items) {
                try {
                    $this->cartService->addProductsCart($items);
                } catch (\DomainException $e) {
                    return redirect()->intended(route('home'));
                }

            }

            return redirect()->intended(route('home'));
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
    }

    public function verify(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $this->validate($request, [
            'token' => 'required|string',
        ]);

        if (!$session = $request->session()->get('auth')) {
            throw new BadRequestHttpException('Missing token info.');
        }

        /** @var User $user */
        $user = User::findOrFail($session['id']);

        if ($request['token'] === $session['token']) {
            $request->session()->flush();
            $this->clearLoginAttempts($request);
            Auth::login($user, $session['remember']);
            return redirect()->intended(route('home'));
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages(['token' => ['Invalid auth token.']]);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->back();
    }

    protected function username()
    {
        return 'email';
    }
}
