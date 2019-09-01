@extends('layouts_admin.master')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="productNameInput">Name</label>
                <input type="text" name="name" class="form-control" id="productNameInput" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="productDescriptionInput">Description</label>
                <textarea class="form-control" name="description" id="productDescriptionInput"
                    rows="4">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="productNameInput">Brand</label>
                <input type="text" name="brand" class="form-control" id="productNameInput"
                    value="{{ $product->brand }}">
            </div>
            <div class="form-group">
                <label for="productPriceInput">Price</label>
                <input type="number" name="cost" class="form-control" id="productPriceInput"
                    value="{{ $product->cost }}">
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="show_best_seller" value="0">
                    <input class="form-check-input" type="checkbox" name="show_best_seller" id="show_best_seller"
                        value="1" @if($product->product_detail->show_best_seller) checked @endif>
                    <label class="form-check-label" for="show_best_seller">Show as Best Seller</label>
                </div>
            </div>
            <div class="form-group">

                <div class="form-check form-check-inline">
                    <input type="hidden" name="show_featured" value="0">
                    <input class="form-check-input" type="checkbox" name="show_featured" id="show_featured" value="1"
                        @if($product->product_detail->show_featured) checked @endif>
                    <label class="form-check-label" for="show_featured">Show as Featured</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="show_have_discount" value="0">
                    <input class="form-check-input" type="checkbox" name="show_have_discount" id="show_have_discount"
                        value="1" @if($product->product_detail->show_have_discount) checked
                    @endif>
                    <label class="form-check-label" for="show_have_discount">Show as Having Discount</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="show_day_of_opportunity" value="0">
                    <input class="form-check-input" type="checkbox" name="show_day_of_opportunity"
                        id="show_day_of_opportunity" value="1" @if($product->product_detail->show_day_of_opportunity)
                    checked @endif>
                    <label class="form-check-label" for="show_day_of_opportunity">Show as Day of Opportunity</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="show_in_slider" value="0">
                    <input class="form-check-input" type="checkbox" name="show_in_slider" id="show_in_slider" value="1"
                        @if($product->product_detail->show_in_slider) checked @endif>
                    <label class="form-check-label" for="show_in_slider">Show in slider</label>
                </div>
            </div>



            <div class="form-group">
                <label for="categorySelector">Categories</label>
                <select multiple="multiple" name="category_id[]" id="tagSelector" class="form-control tag-selector">
                    @foreach ($main_categories as $main_category)
                    @foreach ($main_category->sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}" @if($product->hasCategory($sub_category->id)) selected
                        @endif >{{$main_category->name}}/{{ $sub_category->name }}</option>
                    @endforeach
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="imageInputFile">Images</label>
                <input name='product_image[]' multiple value="{{ old('product_image') }}" type="file"
                    class="form-control-file" id="imageInputFile">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        <hr class="mt-5">

        <h3>Images</h3>

        <div class="form-group">
            <div class="row">
                @foreach ($product->product_images as $product_image)
                <div class="col-md-3">
                    <div class="card">
                        <img style="width:100%" class="card-img-top"
                            src="/uploads/products/{{ $product_image->image_name }}" alt="...">
                        <div class="card-body">
                            <form action="{{ route('admin.product_images.destroy', $product_image->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $product->product_images->count() }}"
                                    name="product_image_count">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        <hr>
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
                <form action="{{route('admin.comments.destroy', $comment->id)}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger btn-md">Delete</button>
                </form>
            </div>
        </div>
        <hr>
        @endforeach

        @else
        <div>No comments available.</div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $('trix-editor').css("min-height", "300px");
    $(".tag-selector").select2({ tags: true });
</script>
@endsection
