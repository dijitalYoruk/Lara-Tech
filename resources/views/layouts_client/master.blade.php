<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("layouts_client.partials.header")
    @yield("css")
</head>

<body>
    <div id="app">
        @include("layouts_client.partials.navbar")
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

            @yield('content')
        </div>
    </div>

    <footer style="background:dodgerblue">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="mt-3 text-light">Lara-Tech</div>
                <hr style="width: 100%; color: white; height: 1px; background-color:#1976D2;" />
                <div class="mb-3 text-light">Copyright © 2019 Lara-Tech All Right Reserved</div>
            </div>
        </div>
    </footer>

    @include("layouts_client.partials.footer")
    @yield("scripts")
</body>

</html>
