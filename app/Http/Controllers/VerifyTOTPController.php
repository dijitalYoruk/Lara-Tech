<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\VerifyTOTPRequest;

class VerifyTOTPController extends Controller
{

    public function index()
    {
        if (Auth::guard('client')->check()) {
            return view('TOTP.index');
        }
        elseif (Auth::guard('administration')->check()) {
            return view('admin_TOTP.index');
        }
    }

    public function check(VerifyTOTPRequest $request)
    {
        $user = null;

        if (Auth::guard('client')->check()) {
            $user = Auth::guard('client')->user();
        }
        elseif (Auth::guard('administration')->check()) {
            $user = Auth::guard('administration')->user();
        }

        if (isset($user)) {
            $user_id = $user->id;
            $totpReal = Cache::get("TOTP_{$user_id}");
            $totpEntered = $request['totp'];

            if (isset($totpReal)) {
                // otp not expired
                if ($totpReal == $totpEntered) {
                    $user->verify();

                    if (Auth::guard('client')->check()) {
                        return redirect(route('client.home'));
                    }
                    elseif (Auth::guard('administration')->check()) {
                        return redirect(route('admin.home'));
                    }

                }
                else { // wrong password
                    return back()->withErrors('Wrong One Time Password.');
                }
            }
            else { // totp expired
                return back()->withErrors('One Time Password Expired.');
            }
        }
    }

    public function resend()
    {
        $user = null;

        if (Auth::guard('client')->check()) {
            $user = Auth::guard('client')->user();
        }
        elseif (Auth::guard('administration')->check()) {
            $user = Auth::guard('administration')->user();
        }

        if (isset($user)) {
            $user->generateTOTP();
            return back();
        }
    }

}
