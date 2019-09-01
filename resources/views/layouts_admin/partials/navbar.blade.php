 <!-- Navbar -->
 <nav class="bg-dark navbar navbar-dark navbar-expand-sm">

    <!-- Brand Name -->
    <a href="{{ route('admin.home') }}" class="navbar-brand">
        <img src="/img/logo.png" width="50px" height="50px" alt="">
    </a>

    <!-- Brand Name -->
    @if(auth()->guard('administration')->user() && auth()->guard('administration')->user()->isTOTPverified())
        <div class="text-light">{{auth()->guard('administration')->user()->name}}</div>

    @else
        <strong class="text-light">Lara-Tech</strong>
    @endif

    <!-- Navbar Toggler -->
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Collapse -->
    <div class="collapse navbar-collapse" id="navbarMenu">

        @if(!auth()->guard('administration')->user())
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Navbar Item -->
           <li class="nav-item">
                <a href="{{route('admin.login')}}" class="nav-link">Sign In</a>
            </li>

        </ul>
        @endif

        @if(auth()->guard('administration')->user() && auth()->guard('administration')->user()->isTOTPverified())

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="btn btn-secondary text-light mr-3">Home</a>
            </li>

            <li class="nav-item">
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary text-light mr-3" type="submit">Logout</button>
                </form>
            </li>

        </ul>
        @endif

    </div>
</nav>
