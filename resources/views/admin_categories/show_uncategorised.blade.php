@extends('layouts_admin.master')

@section('content')
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
                        <span
                            class="badge badge-info">{{ $category->main_category->name }}/{{ $category->name }}</span><br>
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
