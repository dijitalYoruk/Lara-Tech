<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function store(Request $request) {

        $cart_id = Auth::user()->cart->id;
        $product_id = $request['product_id'];

        if ($request->has('quantity')) {
            $quantity = $request['quantity'];
        } else {
            $quantity = 1;
        }

        CartProduct::updateOrCreate([
            'cart_id' => $cart_id,
            'product_id' => $product_id
        ], ['quantity' => $quantity]);

        session()->flash('success', "ADDED");
        return back();
    }

    public function index() {
        $cart_products = Auth::user()->cart->cart_products;
        return view('carts.index')->with("cart_products", $cart_products);
    }

    public function destroy(CartProduct $cart_product) {
        $cart_product->delete();
        return back();
    }

    public function updateProductIncrement(CartProduct $cart_product) {
        if ($cart_product->quantity < 5) {
            $cart_product->quantity = $cart_product->quantity + 1;
            $cart_product->save();
        } else {
            session()->flash('success', "cannot greater than 5.");
        }
        return back();
    }


    public function updateProductDecrement(CartProduct $cart_product) {
        if ($cart_product->quantity > 1) {
            $cart_product->quantity = $cart_product->quantity - 1;
            $cart_product->save();
        } else {
            $cart_product->delete();
        }
        return back();
    }
}
