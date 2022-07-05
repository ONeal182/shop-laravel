<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('main.online_shop') @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('index') }}">
                    @lang('main.online_shop')</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li @routeactive('index')><a href="{{ route('index') }}">Все
                            товары</a></li>
                    <li @routeactive('categories')><a href="{{ route('categories') }}">Категории</a>
                    </li>
                    <li @routeactive('basket')><a href="{{ route('basket') }}">В
                            корзину</a></li>
                    <li><a href="{{ route('index') }}">Сбросить проект в начальное состояние</a></li>
                    <li><a href="{{route('locale', __('main.set_lang'))}}">Переключить язык</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                        </li>
                    @endguest

                    @auth
                        @admin
                            <li><a href="{{ route('orders') }}">Панель администратора</a></li>
                        @else
                            <li><a href="{{ route('person.orders') }}">Личный кабинет</a></li>
                        @endadmin
                        <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                    @endauth
                </ul>

                {{-- <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin/home">Панель администратора</a></li>
                </ul> --}}
            </div>
        </div>
    </nav>


    <div class="container">
        @yield('content')
    </div>
</body>

</html>
