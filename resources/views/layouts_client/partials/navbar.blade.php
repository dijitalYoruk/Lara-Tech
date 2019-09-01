 <!-- Navbar -->
 <nav class="custom-navbar navbar navbar-dark navbar-expand-sm">

     <!-- Brand Name -->
     <a href="{{ route('client.home') }}" class="navbar-brand">
         <img src="/img/logo.png" width="50px" height="50px" alt="">
     </a>

     <!-- Brand Name -->
     @if(auth()->user() && auth()->user()->isTOTPverified())
     <a href="#" class="navbar-brand">
         <div>{{auth()->user()->name}}</div>
     </a>
     @else
        <strong class="text-light">Lara-Tech</strong>
     @endif

     <!-- Navbar Toggler -->
     <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
         <span class="navbar-toggler-icon"></span>
     </button>

     <!-- Navbar Collapse -->
     <div class="collapse navbar-collapse" id="navbarMenu">

         @guest
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto">

             <!-- Navbar Item -->
             <li class="nav-item">
                 <a href="{{route('login')}}" class="nav-link">Sign In</a>
             </li>

             <!-- Navbar Item -->
             <li class="nav-item">
                 <a href="{{route('register')}}" class="nav-link">Sign Up</a>
             </li>

         </ul>
         @endguest

         @if(auth()->user() && auth()->user()->isTOTPverified())

         <ul class="navbar-nav ml-auto">

             <li class="nav-item">
                 <div class="container" style="width:400px">
                     <form method="GET" action="{{ route('client.search') }}">
                         <div class="input-group">
                             <input type="text" name="input" class="form-control" value="{{ old('input') }}">
                             <div class="input-group-append">
                                 <button class="btn btn-info text-light" type="submit">Search</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </li>

             <li class="nav-item">
                 <a href="{{ route('client.home') }}" class="btn btn-info text-light mr-3">Home</a>
             </li>

             <li class="nav-item">

                 <div class="btn-group mr-3">
                     <button type="button" class="btn btn-info dropdown-toggle text-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Account
                     </button>
                     <div class="dropdown-menu dropdown-menu-right">
                         <a class="dropdown-item" href="{{ route('client.cart.index') }}">My Cart</a>
                         <a class="dropdown-item" href="{{ route('client.orders.index') }}">Past Orders</a>
                         <a class="dropdown-item" href="{{ route('client.account_detail.index') }}">Account Details</a>
                         <div class="dropdown-divider"></div>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST">
                             @csrf
                             <button class="dropdown-item" type="submit">Logout</button>
                         </form>
                     </div>
                 </div>
             </li>
         </ul>
         @endif
     </div>
 </nav>
