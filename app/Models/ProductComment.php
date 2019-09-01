<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    protected $table = "product_comments";
    protected $fillable = ["product_id", "user_id", "rating", "content"];

    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function user() {
        return $this->belongsTo(\App\User::class, "user_id");
    }

}
