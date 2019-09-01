<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('client')->check()) {

            if (Auth::guard('client')->user()->hasVerifiedEmail()) {

                if (!Auth::user()->isTOTPverified()) {
                    Auth::guard('client')->logout();
                } else {
                    return redirect( route('client.home') );
                }
            }
        }
        return $next($request);
    }
}
