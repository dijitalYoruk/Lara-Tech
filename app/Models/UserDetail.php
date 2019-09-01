<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "user_details";
    protected $fillable = ["user_id", "phone_number", "address"];

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }

    public function user() {
        return $this->belongsTo(App\User::class);
    }
}
