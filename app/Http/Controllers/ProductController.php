<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Main_Category;
use App\Models\ProductDetail;
use App\Models\Sub_Category;
use Illuminate\Support\Facades\Session;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products_day_opp = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->where('show_day_of_opportunity', '=', '1')
            ->take(3)->get();

        $data = $request->validate(["input" => "required"]);
        $input = $data['input'];
        $products = Product::where('name', 'like', '%' . $input . '%')->paginate(10);
        $main_categories = Main_Category::all();
        $request->flash();
        return view('products.index')
            ->with('products', $products)
            ->with('main_categories', $main_categories)
            ->with('products_day_opp', $products_day_opp);
    }

    public function show(Product $product)
    {
        $main_categories = Main_Category::all();
        return view('products.show')
            ->with('product', $product)
            ->with('main_categories', $main_categories);
    }


    public function admin_index(Request $request)
    {
        $products = null;
        $request->flash();
        $main_categories = Main_Category::with('sub_categories')->get();

        if ($request->has('products_category')) {
            $category = $request->products_category;

            $products = Product::select('products.*')
                ->join('category_products', 'category_products.product_id', '=', 'products.id')
                ->where('category_id', '=', $category)
                ->paginate(10);
        } elseif ($request->has('product_search')) {
            $search = $request->product_search;
            $products = Product::where('name', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->with('categories')
                ->paginate(10);
        } else {
            $products = Product::orderBy('created_at', 'desc')
                ->with('categories')
                ->paginate(10);
        }

        return view('admin_products.index')
            ->with('products', $products)
            ->with('main_categories', $main_categories);
    }

    public function admin_destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();
        return back();
    }

    public function admin_create()
    {
        $main_categories = Main_Category::with('sub_categories')->get();

        return view("admin_products.create")
            ->with('main_categories', $main_categories);
    }

    public function admin_edit(Product $product)
    {
        $main_categories = Main_Category::all();
        return view('admin_products.edit')
            ->with('product', $product)
            ->with('main_categories', $main_categories);
    }

    public function admin_update(Request $request, Product $product)
    {

        $request->validate([
            'name'                    => 'required',
            'description'             => 'required',
            'brand'                   => 'required',
            'cost'                    => 'required',
            'category_id'             => 'required',
            'show_best_seller'        => 'required',
            'show_featured'           => 'required',
            'show_have_discount'      => 'required',
            'show_day_of_opportunity' => 'required',
            'show_in_slider'          => 'required',
            'product_image'           => 'max:4096'
        ]);

        $data = $request->only([
            'name',
            'description',
            'brand',
            'cost',
            'category_id'
        ]);

        $product->update($data);
        $product->product_detail->update([
            'show_best_seller'        => $request['show_best_seller'],
            'show_featured'           => $request['show_featured'],
            'show_have_discount'      => $request['show_have_discount'],
            'show_day_of_opportunity' => $request['show_day_of_opportunity'],
            'show_in_slider'          => $request['show_in_slider'],
        ]);

        $product->categories()->sync($request->category_id);

        if ($request->has('product_image')) {
            $images = $request->file('product_image');

            foreach ($images as $image) {
                $product_image_file_name = $image->hashName();
                $productImage = ProductImage::create([
                    'image_name' => $product_image_file_name,
                    'product_id' => $product->id
                ]);
                $image->move('uploads/products', $productImage->image_name);
            }
        }

        $request->session()->flash('success', 'product updated succesfully.');
        return redirect(route('admin.products.index'));
    }

    public function admin_store(Request $request)
    {
        $request->validate([
            'name'             => 'required',
            'description'      => 'required',
            'brand'            => 'required',
            'price'            => 'required',
            'category_id'      => 'required',
            'product_image'    => 'required | max:4096'
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'brand'       => $request->brand,
            'cost'        => $request->price,
        ]);

        ProductDetail::create([
            'show_best_seller'        => $request->has('show_best_seller'),
            'show_featured'           => $request->has('show_featured'),
            'show_have_discount'      => $request->has('show_have_discount'),
            'show_day_of_opportunity' => $request->has('show_day_of_opportunity'),
            'show_in_slider'          => $request->has('show_in_slider'),
            'product_id'              => $product->id
        ]);

        if ($request->has("category_id")) {
            $product->categories()->attach($request->category_id);
        }

        $images = $request->file('product_image');

        foreach ($images as $image) {
            $product_image_file_name = $image->hashName();
            $productImage = ProductImage::create([
                'image_name' => $product_image_file_name,
                'product_id' => $product->id
            ]);
            $image->move('uploads/products', $productImage->image_name);
        }

        return redirect(route('admin.products.index'));
    }

    public function admin_destroy_product_image(Request $request, ProductImage $product_image)
    {

        $request->validate(['product_image_count' => 'required']);

        if ($request['product_image_count'] > 1) {
            $product_image->deleteImage();
            $product_image->delete();
            return back();
        } else {
            return back()->withErrors(['There needs to be at least one image.']);
        }
    }

    public function client_show_featured()
    {
        $products_featured = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_featured', '=', '1')
            ->paginate(8);

        return view('products.featured')->with('products_featured', $products_featured);
    }

    public function client_show_discount() {
        $products_have_discount = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_have_discount', '=', '1')
            ->paginate(8);

        return view('products.discount')->with('products_have_discount', $products_have_discount);
    }

    public function client_show_best_seller() {
        $products_best_seller = Product::select('products.*')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('show_best_seller', '=', '1')
            ->paginate(8);

        return view('products.best_seller')->with('products_best_seller', $products_best_seller);
    }
}
