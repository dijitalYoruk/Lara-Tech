@extends('layouts_admin.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .checked {
        color: orange;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_name">Name</label>
                <input name="name" value="{{ $user->name }}" type="text" class="form-control" id="user_name">
            </div>
            <div class="form-group">
                <label for="user_email">Email address</label>
                <input name="email" value="{{ $user->email }}" type="email" class="form-control" id="user_email">
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input name="password" type="password" class="form-control" id="user_password">
            </div>
            <div class="form-group">
                <label for="user_phone_number">Phone Number</label>
                <input name="phone_number" value="{{ $user->user_detail->phone_number }}" type="number"
                    class="form-control" id="user_phone_number">
            </div>
            <div class="form-group">
                <label for="user_address">Address</label>
                <textarea name="address" class="form-control" id="user_address"
                    rows="3">{{ $user->user_detail->address }}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('admin.orders.show_user_orders', $user->id) }}" class="btn btn-dark">Orders</a>
        </form>

    </div>
</div>

<div class="card my-5">
    <div class="card-header">Comments</div>

    <div class="card-body">

        @if($user->comments->count() > 0)
        <hr>
        @foreach($user->comments as $comment)
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
