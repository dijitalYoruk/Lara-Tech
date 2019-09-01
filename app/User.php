<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TOTPMail;
use Illuminate\Support\Facades\Cache;
use App\Models\Cart;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductComment;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart() {
        return $this->hasOne(Cart::class);
    }

    public function user_detail() {
        return $this->hasOne(UserDetail::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function comments() {
        return $this->hasMany(ProductComment::class);
    }

    public function has_product_in_cart($product_id) {
        return in_array($product_id, $this->cart->cart_products->pluck("product_id")->toArray());
    }

    public function get_cart_product($product_id) {
        return $this->cart->cart_products()->where('product_id', $product_id)->first();
    }

    public function generateTOTP() {
        // generating password
        $TOTP = rand(100000, 999999);
        $this->sendMailForTOTP($TOTP);
    }

    private function sendMailForTOTP($TOTP) {
        // sending email and stor-
        // ing the password in cache.
        $user_id    = $this->id;
        $user_email = $this->email;
        Cache::put(["TOTP_{$user_id}" => $TOTP], now()->addMinute());
        Mail::to($user_email)->send(new TOTPMail($TOTP));
    }

    public function verify() {
        if (Auth::guard('client')->check()) {
            Auth::guard('client')->user()->update(['is_verified' => true]);
        } elseif (Auth::guard('administration')->check()) {
            Auth::guard('administration')->user()->update(['is_verified' => true]);
        }
    }

    public function isTOTPverified() {
        return $this->is_verified;
    }

}
