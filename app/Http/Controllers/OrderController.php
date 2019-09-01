<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use App\User;

class OrderController extends Controller
{
    public function orderCart() {
        $cart_products = Auth::user()->cart->cart_products;
        return view('orders.order_cart')->with("cart_products", $cart_products);
    }

    public function index() {
        $orders = Auth::user()->orders()->paginate(5);
        return view('orders.index')->with("orders", $orders);
    }

    public function show(Order $order) {
        return view('orders.show')->with("order", $order);
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'credit_card_number' => 'required',
            'cvc' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'credit_card_owner' => 'required'
        ]);

        $order = Order::create([
            'order_credit_card_number' => $validated['credit_card_number'],
            'order_credit_card_owner'  => $validated['credit_card_owner'],
            'order_cvc'                => $validated['cvc'],
            'order_address'            => $validated['address'],
            'order_phone_number'       => $validated['phone_number'],
            'user_id'                  => Auth::id(),
            'order_state'              => "waiting"
        ]);


        $cart_products = Auth::user()->cart->cart_products;

        foreach($cart_products as $cart_product) {
            OrderProduct::create([
                'product_id' => $cart_product->product_id,
                'quantity' => $cart_product->quantity,
                'unit_price' =>  $cart_product->product->cost,
                'order_id' => $order->id,
            ]);

            $cart_product->delete();
        }
        return redirect( route('client.orders.index') );
    }

    public function admin_index() {
        return view('admin_orders.index');
    }

    public function show_user_orders(User $user) {
        $orders = $user->orders()->paginate(5);
        return view('admin_orders.show_user_orders')->with('orders', $orders);
    }

    public function admin_edit(Order $order) {
        return view('admin_orders.edit')->with("order", $order);
    }

}
