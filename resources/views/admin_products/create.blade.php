@extends('layouts_admin.master')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productNameInput">Name</label>
                <input type="text" name="name" class="form-control" id="productNameInput" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="productDescriptionInput">Description</label>
                <textarea class="form-control" name="description" id="productDescriptionInput"
                    rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="productNameInput">Brand</label>
                <input type="text" name="brand" class="form-control" id="productNameInput" value="{{ old('brand') }}">
            </div>
            <div class="form-group">
                <label for="productPriceInput">Price</label>
                <input type="number" name="price" class="form-control" id="productPriceInput"
                    value="{{ old('price') }}">
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_best_seller" id="show_best_seller"
                        @if(old('show_best_seller')) checked @endif>
                    <label class="form-check-label" for="show_best_seller">Show as Best Seller</label>
                </div>
            </div>
            <div class="form-group">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_featured" id="show_featured"
                        @if(old('show_featured')) checked @endif>
                    <label class="form-check-label" for="show_featured">Show as Featured</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_have_discount" id="show_have_discount"
                        @if(old('show_have_discount')) checked @endif>
                    <label class="form-check-label" for="show_have_discount">Show as Having Discount</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_day_of_opportunity"
                        id="show_day_of_opportunity" @if(old('show_day_of_opportunity')) checked @endif>
                    <label class="form-check-label" for="show_day_of_opportunity">Show as Day of Opportunity</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_in_slider" id="show_in_slider"
                        @if(old('show_in_slider')) checked @endif>
                    <label class="form-check-label" for="show_in_slider">Show in slider</label>
                </div>
            </div>

            <div class="form-group">
                <label for="categorySelector">Categories</label>
                <select multiple="multiple" name="category_id[]" id="tagSelector" class="form-control tag-selector">
                    @foreach ($main_categories as $main_category)
                    @foreach ($main_category->sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}">{{$main_category->name}}/{{ $sub_category->name }}
                    </option>
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
