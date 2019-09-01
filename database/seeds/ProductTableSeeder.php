<?php

use Illuminate\Database\Seeder;
use App\Models\ProductDetail;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductDetail::class, 50)->create();
    }
}
