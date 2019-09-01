@extends('layouts_admin\master')

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

        @foreach($orders as $order)

        <div class="card mb-4">
            <h5 class="card-header"> Order Serial: {{ $order->id }}
                <a class="btn btn-primary btn-sm" href="{{ route('admin.orders.edit', $order->id ) }}" role="button">Info</a></h5>
            <div class="card-body">

                <div><strong>Address: </strong> {{ $order->order_address }}</div>
                <div><strong>Phone: </strong> {{ $order->order_phone_number }}</div>
                <div><strong>State: </strong> Waiting</div>

                <div class="row">
                    @foreach($order->order_products as $order_product)
                    <div class="col-md-6">
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img style="width:100%; height:130px"
                                            @if($order_product->product->product_images->count() > 0)
                                        src="/uploads/products/{{ $order_product->product->product_images->first()->image_name }}"
                                        @else src="/img/placeholder.png"
                                        @endif alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-7">
                                        <div>
                                            <strong>Price:</strong>{{ $order_product->unit_price * $order_product->quantity }}$
                                        </div>
                                        <div><strong>Quantity: </strong>{{ $order_product->quantity }}$</div>
                                        <div><strong>Name: </strong>{{ $order_product->product->name }}</div>
                                        <a href="{{ route('client.product.show',  $order_product->product->id) }}"
                                            class="btn btn-info my-1 text-light btn-product btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <div>{{ $orders->links() }}</div>

    </div>

    @endsection
