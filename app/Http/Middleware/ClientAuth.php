<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ClientAuth
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

                if ($request->is('client/TOTP/*')) {

                    // user has already verified TOTP.
                    if (Auth::guard('client')->user()->isTOTPverified()) {
                        Session::flash('success', 'You are already logged in.');
                        return redirect(route("client.home"));
                    }
                    // TOTP not verified.
                    return $next($request);

                } else {

                    if (Auth::guard('client')->user()->isTOTPverified()) {
                        return $next($request);
                    } else {
                        Auth::guard('client')->logout();
                        return redirect(route("login"));
                    }
                }

            } else {
                return redirect( route("verification.notice") )->withErrors(['Please Verify Your Email.']);
            }

        } else {
            return redirect( route('login') )->withErrors(['Please Login']);
        }
    }

}
