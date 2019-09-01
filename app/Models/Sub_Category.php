<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sub_Category extends Model
{
    protected $table = "sub_categories";
    protected $fillable = ["name", "main_category_id"];

    public function main_category() {
        return $this->belongsTo(Main_Category::class, "main_category_id");
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'category_products', "category_id", "product_id");
    }

}
