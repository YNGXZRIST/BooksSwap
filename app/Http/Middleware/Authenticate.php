<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    public function handle($request,Closure $next)
    {

        if (!Auth::check()) {

            return redirect(route('register.index'));
        }

        $user = Auth::user();

        if (!isset($user->email_verified_at)) {


            return redirect(route('auth.notCompleted'));

        }
        return $next($request);
    }
}
