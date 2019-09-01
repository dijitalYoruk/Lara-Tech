@extends('layouts_client.master')

@section('css')
<style>
    .btn-product {
        width: 100%
    }
</style>
@endsection

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Categories
            </div>
            <ul class="list-group list-group-flush">
                @foreach($main_categories as $main_category)
                <a href="{{ route('client.category', $main_category) }}"
                    class="list-group-item list-group-item-action">{{$main_category->name}}</a>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if ($products->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($products as $product)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3 align-self-center">
                                <img style="width:100%; height:100%" @if($product->product_images->count() > 0)
                                src="/uploads/products/{{ $product->product_images->first()->image_name }}"
                                @else src="/img/placeholder.png"
                                @endif alt="" class="img-thumbnail">
                            </div>
                            <div class="col-md-5">
                                <h5><strong>{{ $product->name }}</strong></h5>
                                <div class="my-0">
                                    <strong>Description:</strong>
                                    <div style="display:inline" class="my-0 desc_product">
                                        {{ $product->description }}
                                    </div>
                                </div>
                                <div class="my-0"><strong>Brand:</strong> {{ $product->brand }}</div>
                                <div class="my-0"><strong>Price:</strong> {{ $product->cost }}$</div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <a href="{{ route('client.product.show',  $product->id) }}"
                                    class="btn btn-info my-1 text-light btn-product btn-sm">Details</a>

                                @if (auth()->user()->has_product_in_cart($product->id))
                                <form class="mb-3" method="POST"
                                    action="{{ route('client.cart.destroy', auth()->user()->get_cart_product($product->id)->id ) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-product btn-danger btn-sm">Delete from Cart</button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('client.cart.store') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <button type="submit" class="btn btn-product btn-sm btn-primary my-1">Add To Cart</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <div class="row justify-content-center mt-4">
                    {{$products->appends(['input' => old('input') ])->links()}}
                </div>

                @else
                <div>No Products are available in this search.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @foreach($products_day_opp as $product)
        <div class="card mb-3">
            <img @if($product->product_images->count() > 0)
            src="/uploads/products/{{ $product->product_images->first()->image_name }}"
            @else src="/img/placeholder.png"
            @endif class="card-img-top" alt="...">
            <div class="card-body">
                <h5><strong><a href="{{ route('client.product.show',  $product->id) }}">{{ $product->name }}</a></strong>
                <p class="card-text desc">{{ $product->description }}</p>
                <strong>€ {{ $product->cost }}</strong>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    const descriptions1 = document.querySelectorAll('.desc');
    for (const description of descriptions1) {
        let truncated = description.innerText;
        if (truncated.length > 60)
            truncated = truncated.substr(0, 60) + '...';
        description.innerText = truncated;
    }

    const descriptions2 = document.querySelectorAll('.desc_product');
    for (const description of descriptions2) {
        let truncated = description.innerText;
        if (truncated.length > 50)
            truncated = truncated.substr(0, 50) + '...';
        description.innerText = truncated;
    }
</script>
@endsection

@section('content2')
<footer style="background:dodgerblue">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="mt-3 text-light">Lara Shop</div>
            <hr style="width: 100%; color: white; height: 1px; background-color:#1976D2;" />
            <div class="mb-3 text-light">Copyright © 2019 Mobiversite All Right Reserved</div>
        </div>
    </div>
</footer>
@endsection
