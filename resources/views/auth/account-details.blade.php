@extends('layouts_client\master')

@section('content')
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">

        <form method="POST" action="{{ route('client.account_detail.update', $user->id) }}">
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
                <label for="user_phone_number">Phone Number</label>
                <input name="phone_number" value="{{ $user->user_detail->phone_number }}" type="number" class="form-control" id="user_phone_number">
            </div>
            <div class="form-group">
                <label for="user_address">Address</label>
                <textarea name="address" class="form-control" id="user_address" rows="3">{{ $user->user_detail->address }}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
        </form>

    </div>
</div>
@endsection
