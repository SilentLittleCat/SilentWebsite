<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('image/icon/icon.png') }}">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower/semantic/dist/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower/cropperjs/dist/cropper.css') }}">

    <style type="text/css">
        * {
            font-family: "Comic Sans MS", cursive, sans-serif;
        }
        #master-header {
            padding: 0px;
        }
        #master-header .ui.menu .ui.image {
            width: 50px;
        }
        #master-header .ui.menu .item {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .ui.menu .right.item .ui.dropdown {
            width: 100px;
        }
        #master-header {
            position: fixed;
            margin: 0px;
            padding: 0px 100px;
            width: 100%;
            z-index: 1000
        }
    </style>
    @yield('style')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div id="master-header" class="ui inverted vertical masthead center align segment">
            <div class="ui large secondary menu">
                <div class="left item">
                    <a href="{{ url('/home') }}">
                        <img class="ui image" src="{{ url('image/icon/icon1.png') }}">
                    </a>
                </div>
                @if(Auth::check())
                    <div class="right item">
                        <div class="ui fluid pointing dropdown">
                            <img class="ui circular centered image" src="{{ url(Auth::user()->avatar) }}">
                            <div class="menu">
                                <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 0.2em">
                                    <i class="sign out icon"></i>@lang('messages.logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="right item">
                        <a href="{{ url('/login') }}" class="ui inverted button" style="margin-right: 10px">@lang('messages.login')</a>
                        <a href="{{ url('/register') }}" class="ui inverted button">@lang('messages.register')</a>
                    </div>
                @endif
            </div>
        </div>
        @yield('content')
    </div>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="{{ asset('bower/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('bower/semantic/dist/semantic.js') }}"></script>
    <script src="{{ asset('bower/jquery.scrollTo/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('bower/cropperjs/dist/cropper.js') }}"></script>
    <script src="{{ asset('bower/Snap.svg/dist/snap.svg.js') }}"></script>
    <script src="{{ asset('bower/flat-surface-shader/deploy/fss.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.ui.dropdown').dropdown({
                on: 'hover'
            });
            $('.ui.sticky').sticky({
                context: '#code-content'
            });
        });
    </script>
    @yield('script')
</body>
</html>