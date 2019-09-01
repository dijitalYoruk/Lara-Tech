@extends('layouts_client.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .checked {
        color: orange;
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

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

                <h5 class="text-center my-3"><strong>{{ $product->name }}</strong></h5>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-center">
                        @if($product->product_images->count() > 0)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for($i = 0; $i < $product->product_images->count(); $i++)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($i==0)
                                        class="active" @endif></li>
                                    @endfor
                            </ol>
                            <div class="carousel-inner">
                                @for($i = 0; $i < $product->product_images->count(); $i++)
                                    <div @if($i==0) class="carousel-item active" @else class="carousel-item" @endif>
                                        <img src="/uploads/products/{{ $product->product_images[$i]->image_name }}"
                                            height="300px" class="card-img-top" alt="...">
                                    </div>
                                    @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        @else
                        <img width="350px" height="350px" src="/img/placeholder.png" alt="">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Brand:</strong> {{ $product->brand }}</p>
                        <p><strong>Price:</strong> {{ $product->cost }}$</p>
                        <p>
                            <strong>Categories: </strong>
                            @foreach($product->categories as $category)
                            <span
                                class="badge badge-info">{{ $category->main_category->name }}/{{ $category->name }}</span>
                            @endforeach
                        </p>

                        @if (auth()->user()->has_product_in_cart($product->id))
                        <form class="mb-3" method="POST"
                            action="{{ route('client.cart.destroy', auth()->user()->get_cart_product($product->id)->id ) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete from Cart</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('client.cart.store') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="quantity">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="card my-5">
            <div class="card-header">Comments</div>

            <div class="card-body">

                @if($product->comments->count() > 0)
                <hr>
                @foreach($product->comments as $comment)
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <p class="my-0"><strong>Comment: </strong>{{$comment->content}}</p>
                        <p class="my-0"><strong>Rating: </strong>

                            @for ($i = 0; $i < $comment->rating; $i++)
                                <span class="fa fa-star checked"></span>
                                @endfor

                                @for ($i = 0; $i < 5 - $comment->rating; $i++)
                                    <span class="fa fa-star"></span>
                                    @endfor

                            <strong class="ml-3">Author: </strong>{{$comment->user->name}}
                        </p>
                        <p class="my-0"></p>
                    </div>
                    <div class="col-md-2">
                        @if ($comment->user->id == auth()->user()->id)
                        <form action="{{route('client.comments.destroy', $comment->id)}}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-danger btn-md">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
                <hr>
                @endforeach

                @else
                <div>No comments available.</div>
                @endif
            </div>
        </div>

        @if ($product->user_id != auth()->user()->id)

        <div class="card my-5">
            <div class="card-header">Make Comment</div>

            <div class="card-body">
                <form action="{{ route('client.comments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="postCommentInput" rows="3"></textarea>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-group">
                            <label for="ratingInput">Rating</label>
                            <select name="rating" class="form-control" id="ratingInput">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Comment</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
