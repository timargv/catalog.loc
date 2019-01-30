<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, User $user)
    {
        if(Auth::check() && $user->isAdmin() || $user->isModerator() )
        {
            return $next($request);
        }

        abort(404);

    }
}

