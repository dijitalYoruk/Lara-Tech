@extends('layouts_admin.master')

@section('content')
<div class="card">
    <div class="card-header">Category</div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error){{ $error }}@endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="categoryNameInput">Category Name</label>
                <input name="name" type="text" class="form-control" id="categoryNameInput">
            </div>
            <button type="submit" class="btn btn-sm btn-success">Create Category</button>
        </form>
    </div>
</div>
@endsection
