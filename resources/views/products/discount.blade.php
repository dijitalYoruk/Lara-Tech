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

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Discounts</div>

            <div class="card-body">
                @if ($products_have_discount->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($products_have_discount as $product)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3 align-self-center">
                                    <img style="max-height:200px; max-width:130px" @if($product->product_images->count() > 0)
                                    src="/uploads/products/{{ $product->product_images->first()->image_name }}"
                                    @else src="/img/placeholder.png"
                                    @endif class="card-img-top" alt="...">                            </div>
                            <div class="col-md-6 align-self-center">
                                <h5><strong>{{ $product->name }}</strong></h5>
                                <div class="my-0">
                                    <strong>Description:</strong>
                                    <div style="display:inline" class="desc my-0">
                                        {{ $product->description }}
                                    </div>
                                </div>
                                <div class="my-0"><strong>Brand:</strong> {{ $product->brand }}</div>
                                <div class="my-0"><strong>Price:</strong> {{ $product->cost }}$</div>
                            </div>
                            <div class="col-md-3 align-self-center">
                                <a href="{{ route('client.product.show', $product->id) }}" class="btn btn-product btn-info my-1 text-light">Details</a>

                                @if (auth()->user()->has_product_in_cart($product->id))
                                <form class="mb-3" method="POST"
                                    action="{{ route('client.cart.destroy', auth()->user()->get_cart_product($product->id)->id ) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-product btn-danger">Delete from Cart</button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('client.cart.store') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <button type="submit" class="btn btn-product btn-primary my-1">Add To Cart</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <div class="row mt-4 justify-content-center">
                        {{ $products_have_discount->links() }}
                     </div>

                @else
                <div>No Products are available.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const descriptions = document.querySelectorAll('.desc');
    for (const description of descriptions) {
        let truncated = description.innerText;
        if (truncated.length > 100)
            truncated = truncated.substr(0, 140) + '...';
        description.innerText = truncated;
    }
</script>
@endsection
