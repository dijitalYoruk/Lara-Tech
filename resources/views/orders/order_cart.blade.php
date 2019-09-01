@extends('layouts_client.master')

@section('content')
<div class="row">

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
    @foreach ($errors->all() as $error){{ $error }}@endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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
        <div class="card mb-5">
            <div class="card-header">Your Cart</div>

            <div class="card-body">

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
                                        <img style="width:100%; height:100%" @if( $cart_product->product->product_images->count() > 0)
                                        src="/uploads/products/{{ $cart_product->product->product_images->first()->image_name }}"
                                        @else src="/img/placeholder.png"
                                        @endif alt="" class="img-thumbnail">                                    <div class="text-center my-2">{{ $cart_product->product->name }}</div>
                                </div>
                            </td>

                            <td class="col-md-2">
                                <div class="text-center">
                                    {{ $cart_product->product->cost }}$
                                </div>
                            </td>
                            <td  class="col-md-3">
                                <div class="text-center">
                                    <form style="display:inline" method="POST" action="{{ route('client.cart.update.decrement', $cart_product->id) }}">
                                        @csrf
                                        <button type="submit" style="width:30px" class="btn btn-sm btn-outline-primary">-</button>
                                    </form>

                                    {{ $cart_product->quantity }}
                                    <form style="display:inline" method="POST" action="{{ route('client.cart.update.increment', $cart_product->id) }}">
                                        @csrf
                                        <button type="submit" style="width:30px" class="btn btn-sm btn-outline-primary">+</button>
                                    </form>

                                </div>

                            </td>
                            <td style="vertical-align: middle;"  class="col-md-2">
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




            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Order Info</div>

            <div class="card-body">

                <form method="POST" action="{{ route('client.orders.store') }}">
                @csrf

                <div class="form-group">
                            <label for="inputCreditCardOwner">Credit Card Owner</label>
                            <input type="text" class="form-control" name="credit_card_owner" id="inputCreditCardOwner">
                        </div>
                    <div class="form-group">
                            <label for="inputCreditCard">Credit Card Number</label>
                            <input type="text" class="form-control" name="credit_card_number" id="inputCreditCard" placeholder="xxxx-xxxx-xxxx-xxxx">
                        </div>
                    <div class="form-group">
                            <label for="inputCVC">CVC</label>
                            <input type="text" class="form-control" id="inputCVC" name="cvc" placeholder="Password">
                        </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <textarea type="text" rows="4" class="form-control" id="inputAddress" name="address">{{ auth()->user()->user_detail->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone">Phone Number</label>
                        <input type="text" class="form-control" id="inputPhone" name='phone_number' value="{{ auth()->user()->user_detail->phone_number }}">
                    </div>
                        <div class="form-group">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity" name='city'>
                        </div>

                    <button type="submit" class="btn btn-primary">Order</button>
                </form>


            </div>
        </div>
    </div>




</div>

@endsection
