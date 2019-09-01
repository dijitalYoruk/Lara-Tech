<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = "product_details";
    public $timestamps = false;
    protected $fillable = [
        "show_best_seller",
        "show_featured",
        "show_have_discount",
        "show_day_of_opportunity",
        "show_in_slider",
        "product_id"
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
