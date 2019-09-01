<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuth
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
        if (Auth::guard('administration')->check()) {

            if (Auth::guard('administration')->user()->hasVerifiedEmail()) {

                if ($request->is('admin/TOTP/*')) {

                    // user has already verified TOTP.
                    if (Auth::guard('administration')->user()->isTOTPverified()) {
                        Session::flash('success', 'You are already logged in.');
                        return redirect(route("admin.home"));
                    }
                    // TOTP not verified.
                    return $next($request);

                } else {

                    if (Auth::guard('administration')->user()->isTOTPverified()) {
                        return $next($request);
                    } else {
                        Auth::guard('administration')->logout();
                        return redirect(route("admin.login"));
                    }
                }

            } else {
                return redirect( route('admin.login') )->withErrors(['Please Verify You Email.']);
            }

        } else {
            return redirect( route('admin.login') )->withErrors(['Please Login']);
        }

    }

}
