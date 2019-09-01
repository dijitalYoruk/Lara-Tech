@extends('layouts_admin.master')

@section('content')

<div class="card mb-3">
    <div class="card-body">

        <div class="row">
            <div class="col-md-5">
                <form action="{{ route('admin.products.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" placeholder="Search" class="form-control" name="product_search"
                            value="{{ old('product_search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">

                <form action="{{ route('admin.products.index') }}" method="GET">
                    <div class="input-group">
                        <select class="custom-select" name="products_category" id="inputGroupSelect04">
                            @if (old('products_category') != null)
                            @foreach ($main_categories as $main_category)
                            @foreach ($main_category->sub_categories as $sub_category)
                            <option @if (old('products_category')==$sub_category->id) selected @endif
                                value="{{ $sub_category->id }}">{{$main_category->name}}/{{ $sub_category->name }}
                            </option>
                            @endforeach
                            @endforeach
                            @else
                            <option selected>Choose...</option>
                            @foreach ($main_categories as $main_category)
                            @foreach ($main_category->sub_categories as $sub_category)
                            <option value="{{ $sub_category->id }}">
                                {{$main_category->name}}/{{ $sub_category->name }}</option>
                            @endforeach
                            @endforeach
                            @endif
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-1">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>

            <div class="col-md-2" style="width:100%">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create</a>
            </div>

        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr class="row table-warning table-bordered mx-2">
                    <th class="col-md-2" scope="col">Name</th>
                    <th class="col-md-2" scope="col">Price</th>
                    <th class="col-md-2" scope="col">Categories</th>
                    <th class="col-md-2" scope="col">Brand</th>
                    <th class="col-md-2" scope="col">Created At</th>
                    <th class="col-md-2" scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="row table-bordered mx-2">
                    <td class="col-md-2" style="vertical-align: middle;">
                        {{ $product->name }}
                    </td>
                    <td class="col-md-2" style="vertical-align: middle;">
                        {{ $product->cost }}
                    </td>
                    <td class="col-md-2" style="vertical-align: middle;">
                        @foreach($product->categories as $category)
                        <span class="badge badge-info">{{ $category->main_category->name }}/{{ $category->name }}</span><br>
                        @endforeach
                    </td>
                    <td class="col-md-2" style="vertical-align: middle;">
                        {{ $product->brand }}
                    </td>
                    <td class="col-md-2" style="vertical-align: middle;">
                        {{ $product->created_at }}
                    </td>

                    <td class="col-md-2" style="vertical-align: middle;">
                        <a href="{{ route('admin.products.edit', $product) }}" style="width:80%"
                            class="btn my-1 btn-sm btn-primary">Edit</a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="width:80%" type="submit" class="btn my-1 btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->appends(Request::all())->links()  }}

    </div>
</div>
@endsection
