<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGuest
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
            if (!Auth::guard('administration')->user()->isTOTPverified()) {
                Auth::guard('administration')->logout();
            } else {
                return redirect( route('admin.home') );
            }
        }
        return $next($request);
    }
}
