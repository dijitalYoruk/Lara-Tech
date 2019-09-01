<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cart extends Model
{
    protected $table = "carts";
    protected $fillable = ["user_id"];

    public function cart_products() {
        return $this->hasMany(CartProduct::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
