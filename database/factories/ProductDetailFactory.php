<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\ProductDetail;
use App\Models\Product;

$factory->define(ProductDetail::class, function (Faker $faker) {
    return [
        'show_day_of_opportunity' => rand(0,1),
        'show_best_seller' => rand(0,1),
        'show_have_discount' => rand(0,1),
        'show_in_slider' => rand(0,1),
        'show_featured' => rand(0,1),
        'product_id' => factory(Product::class)->create()->id,
    ];
});
