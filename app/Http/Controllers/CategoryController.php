<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_Category;
use App\Models\Sub_Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Main_Category $main_category)
    {
        $sub_category = $main_category->sub_categories()->first();
        $products = $sub_category->products()->paginate(8);;

        return view('categories.index')
            ->with("main_category", $main_category)
            ->with("sub_category",  $sub_category)
            ->with("products",  $products);
    }

    public function show(Main_Category $main_category, Sub_Category $sub_category)
    {
        $products = $sub_category->products()->paginate(8);;
        return view('categories.show')
            ->with("main_category", $main_category)
            ->with("sub_category",  $sub_category)
            ->with("products",  $products);
    }

    public function admin_index()
    {
        return view('admin_categories.index')
            ->with("main_categories", Main_Category::all());
    }

    public function admin_create()
    {
        return view('admin_categories.create');
    }


    public function admin_store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Main_Category::create([
            'name' => $request->name
        ]);

        return redirect(route('admin.category.index'));
    }

    public function admin_show(Main_Category $main_category) {
        $sub_categories = $main_category->sub_categories;
        return view('admin_categories.show')
            ->with('main_category',  $main_category)
            ->with('sub_categories', $sub_categories);
    }


    public function admin_store_sub_category( Main_Category $main_category, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Sub_Category::create([
            'name' => $request->name,
            'main_category_id'=> $main_category->id
        ]);

        return back();
    }

    public function admin_destroy_main_category(Main_Category $main_category) {
        $main_category->delete();
        return back();
    }

    public function admin_destroy_sub_category(Sub_Category $sub_category) {
        $sub_category->delete();
        return back();
    }

    public function admin_show_sub_category(Sub_Category $sub_category) {
        $products = $sub_category->products()->paginate(10);
        return view('admin_categories.show_sub_category')
            ->with('products', $products)
            ->with('sub_category', $sub_category);
    }

    public function admin_show_uncategorised() {

        $products = Product::doesnthave('categories')->paginate(10);

        return view('admin_categories.show_uncategorised')
            ->with('products', $products);
    }

}
