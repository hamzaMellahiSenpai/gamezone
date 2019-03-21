<nav class="navbar navbar-expand-lg navbar-white bg-white">
            <div class="container p-0 m-0">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white!important">
                    <!--<i class="fas fa-gamepad"></i>
                    <i class="ios-game-controller-a-outline"></i>-->
                    <i class="ion-ios-game-controller-b-outline"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('about')}}">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('services') }}">Services</a>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ url('storage/images/' . auth()->user()->avatar ) }}"style="width:60px;height:60px">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href='/users/{{ Auth::user()->name }}/profile'>My Profile</a>
                                    <a class="dropdown-item" href="/posts/create"><i class="fa fa-plus"></i>Create new post</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
    <div class="overlay">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 bg-white"></div>
            <div class="col-md-3 bg-light"></div>
        </div>
    </div>
</nav>
