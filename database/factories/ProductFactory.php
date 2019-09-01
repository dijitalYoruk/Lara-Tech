<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'description'       => $faker->sentence(30),
        'brand'             => $faker->sentence(1),
        'cost'              => $faker->randomFloat(2, 10, 1000),
    ];
});
