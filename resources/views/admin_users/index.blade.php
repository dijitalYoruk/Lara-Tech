@extends('layouts_admin.master')

@section('content')
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">
        <table class="table my-0 table-bordered">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td style="vertical-align: middle;">{{ $user->name }}</td>
                    <td style="vertical-align: middle;">{{ $user->email}}</td>
                    <td style="vertical-align: middle;">{{ $user->created_at}}</td>
                <td style="vertical-align: middle;"><a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
