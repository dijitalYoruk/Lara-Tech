<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* $this->middleware('guest')->except('logout');
        $this->middleware('checkUnverifiedTOTP', ['only' => ['login']]); */
    }

    public function showLoginForm()
    {
        if (request()->is('admin/*')) {
            return view('auth_admin.login');
        } elseif (request()->is('client/*')) {
            return view('auth.login');
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request) {

        $result = null;

        if ($request->is('client/*')) {

            $credentials = [
                "email" => $request["email"],
                "password" => $request["password"],
                "is_admin" => false
            ];

            $result = Auth::guard('client')->attempt($credentials, $request->filled('remember'));

            if ($result && Auth::guard('client')->user()->hasVerifiedEmail())
                Auth::guard('client')->user()->generateTOTP();

        } elseif($request->is('admin/*')) {

            $credentials = [
                "email" => $request["email"],
                "password" => $request["password"],
                "is_admin" => true
            ];

            $result = Auth::guard('administration')->attempt(
                $credentials, $request->filled('remember')
            );

            if ($result &&  Auth::guard('administration')->user()->hasVerifiedEmail())
                Auth::guard('administration')->user()->generateTOTP();
        }

        return $result;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {

        if (Auth::guard('client')->check()) {
            Auth::guard('client')->user();
            Auth::guard('client')->user()->update(['is_verified' => false]);
            Auth::guard('client')->logout();
        }
        elseif (Auth::guard('administration')->check()) {
            Auth::guard('administration')->user();
            Auth::guard('administration')->user()->update(['is_verified' => false]);
            Auth::guard('administration')->logout();
        }

        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user) {
        if (Auth::guard('client')->check()) {
            return redirect(route('client.TOTP.index'));
        } elseif (Auth::guard('administration')->check()) {
            return redirect(route('admin.TOTP.index'));
        } else {
            return redirect("/");
        }
    }

}
