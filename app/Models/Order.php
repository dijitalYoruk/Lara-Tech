<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ["user_id", "order_credit_card_number", "order_credit_card_owner", "order_cvc", "order_phone_number", "order_address", "order_state"];

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }

    public function user() {
        return $this->belongsTo(App\User::class);
    }

}