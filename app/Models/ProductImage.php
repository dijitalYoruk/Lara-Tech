<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ProductImage extends Model
{
    protected $table = "product_images";
    public $timestamps = false;
    protected $fillable = ["image_name", "product_id"];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function deleteImage()
    {
        $image_path = "uploads/products/" . $this->image_name;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}
