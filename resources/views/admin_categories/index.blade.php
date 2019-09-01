@extends('layouts_admin.master')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mainCategoryModal">
            Create Main Category
        </button>
        <a href="{{ route('admin.category.show_uncategorised') }}" class="btn btn-secondary">Show Uncategorised
            Products</a>
    </div>
</div>

<div class="card">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <table class="table my-0 table-bordered">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($main_categories as $category)
                <tr>
                    <td style="vertical-align: middle;">{{ $category->name }}</td>
                    <td style="vertical-align: middle;">{{ $category->created_at}}</td>
                    <td style="vertical-align: middle;">
                        <a href="{{ route('admin.category.show', $category->id) }}"
                            class="btn btn-sm btn-primary">View</a>

                        <form style="display:inline"
                            action="{{ route('admin.category.destroy_main_category', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">delete</button>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mainCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Main Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Please Enter Category Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" href="{{ route('admin.category.create') }}" class="btn btn-primary">Create
                        Main Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
