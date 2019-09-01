@extends('layouts_client.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
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
                <a href="{{ route('client.category', $main_category->id) }}"
                    class="list-group-item list-group-item-action">{{$main_category->name}}</a>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Lara-Shop</div>

            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img height="300px"
                                src="https://www.tvadsongs.uk/wp-content/uploads/2018/06/twilight-huawei-p20-pro-8211-let-me-see-you-move-1NoTukEc0Xs.jpg"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="300px"
                                src="https://images10.newegg.com/BizIntell/item/34/854/34-854-594/0.jpg"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="300px"
                                src="https://www.lowyat.net/wp-content/uploads/2018/08/nvidia-geforce-rtx-preorder-my-01-770x416.jpg"
                                class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">

        <div class="card ">
            <div class="card-body px-0 py-0">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        @for($i = 0; $i < $products_day_opp->count(); $i++)
                            <div @if($i==0) class="carousel-item active" @else class="carousel-item" @endif>
                                <img @if($products_day_opp[$i]->product_images->count() > 0)
                                src="/uploads/products/{{ $products_day_opp[$i]->product_images->first()->image_name }}"
                                @else src="/img/placeholder.png"
                                @endif

                                height="200px" class="card-img-top" alt="...">
                                <div class="py-3 text-center">
                                    <h5><strong><a href="{{ route('client.product.show',  $products_day_opp[$i]->id) }}">{{ $products_day_opp[$i]->name }}</a></strong></h5>
                                    <strong>€ {{ $products_day_opp[$i]->cost }}</strong>
                                    <div class="my-1"><a
                                            href="{{ route('client.product.show', $products_day_opp[$i]->id) }}"
                                            class="btn btn-info">Details</a></div>
                                </div>
                            </div>
                            @endfor

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <a class="text-dark" href="{{ route('client.product.client_show_best_seller') }}">Best Seller</a>
        </div>
        <div class="card-body pt-3">
            <div class="owl-carousel owl-theme">
                @foreach($products_best_seller as $product)
                <div class="item">
                    <div class="card">
                        <img style="height:120px;" @if($product->product_images->count() > 0)
                        src="/uploads/products/{{ $product->product_images->first()->image_name }}"
                        @else src="/img/placeholder.png"
                        @endif class="card-img-top" alt="...">

                        <div class="card-body py-1">
                            <div class="py-0"><strong><a href="{{ route('client.product.show',  $product->id) }}">{{ $product->name }}</a></strong></div>
                            <div class="py-0">${{ $product->cost }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <a class="text-dark" href="{{ route('client.product.client_show_discount') }}">Discount</a>
        </div>
        <div class="card-body pt-3">
            <div class="owl-carousel owl-theme">
                @foreach($products_have_discount as $product)
                <div class="item">
                    <div class="card">

                        <img style="height:120px;" @if($product->product_images->count() > 0)
                        src="/uploads/products/{{ $product->product_images->first()->image_name }}"
                        @else src="/img/placeholder.png"
                        @endif class="card-img-top" alt="...">

                        <div class="card-body py-1">
                            <div class="py-0"><strong><a href="{{ route('client.product.show',  $product->id) }}">{{ $product->name }}</a></strong></div>
                            <div class="py-0">${{ $product->cost }}</div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <a class="text-dark" href="{{ route('client.product.client_show_featured') }}">Featured</a>
        </div>
        <div class="card-body pt-3">
            <div class="owl-carousel owl-theme">
                @foreach($products_featured as $product)
                <div class="item">
                    <div class="card">
                        <img style="height:120px;" @if($product->product_images->count() > 0)
                        src="/uploads/products/{{ $product->product_images->first()->image_name }}"
                        @else src="/img/placeholder.png"
                        @endif class="card-img-top" alt="...">

                        <div class="card-body py-1">
                            <div class="py-0"><strong><a href="{{ route('client.product.show',  $product->id) }}">{{ $product->name }}</a></strong></div>
                            <div class="py-0">${{ $product->cost }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });
</script>
@endsection
