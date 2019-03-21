<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ionicons -->
    <link rel="stylesheet" href='css/ionicons.min.css'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @php 
            if(isset($title)){
                echo $title;
            }
            else {
                echo config('app.name');
            }
        @endphp
    </title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome-all-v5.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if(Request::is('login') || Request::is('register') || Request::is('admin*'))
            <div class="container pt-5">
                @include('inc.navbar')
                @yield('content')
            </div>
        @else
            @include('inc.navbar')
            @include('inc.slider')
                    @if(!Request::is('posts*'))
                        @yield('inc.messages')
                        @yield('content')
                    @else
                        <div class="row py-5">
                            <div class="content-wrapper col-sm-12 col-md-8">
                                @yield('inc.messages')
                                @yield('content')
                            </div>
                            <aside class="col-sm-12 col-md-4">
                                @include('inc.sidebar')
                            </aside>
                        </div>
                    @endif
            @include('inc.pop_up')
            @include('inc.footer')
            <span id="scrollToTop">
                <i class="fas fa-angle-double-up"></i>
            </span>  
        @endif
    </div>
    <!--<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
    <script src="asset('css/app.js')"></script>
    -->
    <script type="text/javascript">
        let token        = '{{ Session::token() }}';
        let url_like     = '{{ route('like') }}',
            url_dislike  = '{{ route('dislike') }}';
        let url = '{{ route("count") }}';
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
