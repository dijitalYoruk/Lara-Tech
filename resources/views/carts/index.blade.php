@extends('layouts_client.master')

@section('content')
<div class="row">

    @if ($message = session()->get('success'))
    <div class="container my-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Your Cart</div>

            <div class="card-body">

                @if ($cart_products->count() > 0)

                <table class="table table-bordered  table-striped">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-md-2 text-center" scope="col">Product</th>
                            <th class="col-md-2 text-center" scope="col">Unit Amount</th>
                            <th class="col-md-3 text-center" scope="col">Quantity</th>
                            <th class="col-md-2 text-center" scope="col">Sum</th>
                            <th class="col-md-3 text-center" scope="col">Operations</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cart_products as $cart_product)
                        <tr class="d-flex">
                            <td class="col-md-2">
                                <div>
                                    <img style="width:100%; height:100%" @if(
                                        $cart_product->product->product_images->count() > 0)
                                    src="/uploads/products/{{ $cart_product->product->product_images->first()->image_name }}"
                                    @else src="/img/placeholder.png"
                                    @endif alt="" class="img-thumbnail">
                                    <div class="text-center my-2">{{ $cart_product->product->name }}</div>
                                </div>
                            </td>

                            <td class="col-md-2">
                                <div class="text-center">
                                    {{ $cart_product->product->cost }}$
                                </div>
                            </td>
                            <td class="col-md-3">
                                <div class="text-center">
                                    <form style="display:inline" method="POST"
                                        action="{{ route('client.cart.update.decrement', $cart_product->id) }}">
                                        @csrf
                                        <button type="submit" style="width:30px"
                                            class="btn btn-sm btn-outline-primary">-</button>
                                    </form>

                                    {{ $cart_product->quantity }}

                                    <form style="display:inline" method="POST"
                                        action="{{ route('client.cart.update.increment', $cart_product->id) }}">
                                        @csrf
                                        <button type="submit" style="width:30px"
                                            class="btn btn-sm btn-outline-primary">+</button>
                                    </form>

                                </div>

                            </td>
                            <td style="vertical-align: middle;" class="col-md-2">
                                <div class="text-center">
                                    {{ $cart_product->quantity *  $cart_product->product->cost }}$
                                </div>
                            </td>
                            <td style="vertical-align: middle;" class="col-md-3">
                                <div class="text-center">
                                    <form method="POST" action="{{ route('client.cart.destroy', $cart_product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    <a style="width:300px" href="{{ route('client.orders.order_cart') }}"
                        class="btn btn-outline-dark">Order</a>
                </div>

                @else
                <div class="text-center">No products are available in cart.</div>
                @endif



            </div>
        </div>
    </div>
</div>
@endsection
