<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("layouts_admin.partials.header")
    @yield("css")
</head>

<body>
    <div id="app">
        @include("layouts_admin.partials.navbar")
        <div class="py-5 container">
            @if ($message = session()->get('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if ($message = session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (auth()->guard('administration')->check() && auth()->guard('administration')->user()->isTOTPverified())
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Admin Panel
                        </div>
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('admin.users.index') }}"
                                class="list-group-item list-group-item-action">Users</a>
                            <a href="{{ route('admin.category.index') }}"
                                class="list-group-item list-group-item-action">Categories</a>
                            <a href="{{ route('admin.products.index') }}"
                                class="list-group-item list-group-item-action">Products</a>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
            @else
            @yield('content')
            @endif
        </div>
    </div>

    <footer class="bg-dark">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="mt-3 text-light">Lara Tech</div>
                    <hr style="width: 100%; color: white; height: 1px; background-color:#1976D2;" />
                    <div class="mb-3 text-light">Copyright © 2019 Lara-Tech All Right Reserved</div>
                </div>
            </div>
        </footer>

    @include("layouts_admin.partials.footer")
    @yield("scripts")
</body>

</html>
