<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ["name", "description", "brand", "cost"];

    public function categories() {
        return $this->belongsToMany(Sub_Category::class, 'category_products', "product_id", "category_id");
    }

    public function product_images() {
        return $this->hasMany(ProductImage::class);
    }

    public function product_detail() {
        return $this->hasOne(ProductDetail::class);
    }

    public function comments() {
        return $this->hasMany(ProductComment::class);
    }

    public function hasCategory($categoryId) {
        return in_array($categoryId, $this->categories->pluck("id")->toArray());
    }

    public function deleteImage() {
        Storage::delete($this->image);
    }

}
