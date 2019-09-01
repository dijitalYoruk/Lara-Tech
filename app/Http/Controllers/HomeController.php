<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $products_day_opp = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_day_of_opportunity', '=', '1')
            ->take(5)->get();

        $products_best_seller = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_best_seller', '=', '1')
            ->take(12)->get();

        $products_have_discount = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_have_discount', '=', '1')
            ->take(12)->get();

        $products_featured = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_featured', '=', '1')
            ->take(12)->get();

        $main_categories = Main_Category::all();

        return view('home')
            ->with("main_categories", $main_categories)
            ->with("products_best_seller", $products_best_seller)
            ->with("products_have_discount", $products_have_discount)
            ->with("products_featured", $products_featured)
            ->with("products_day_opp", $products_day_opp);
    }

    public function admin_index()
    {
        return view('admin_home');
    }

}
