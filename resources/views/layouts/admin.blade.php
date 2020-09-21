<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GEP') }}</title>
    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Monoton|Quicksand|Raleway|Roboto|Montserrat|Oswald|Poppins" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ URL::asset('imgs/school.png') }}" type="image/x-icon"/>
    @yield('styles')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100%;
            margin: 0;
            scroll-behavior: smooth;
            overflow: auto;
        }

        body{
            position: relative;
            display: grid;
            margin-bottom: 0 !important;
            /*flex-direction: column;*/
        }

        .logoText{
            font-family: 'Monoton', sans-serif;
            letter-spacing: .1rem;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        #footerText{
            margin-top: 20px;
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            font-weight: bold;
        }

        .my_footer{
            position:absolute;
            display: grid;
            place-items: center;
            flex: 1;
            flex-shrink: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            background-color: #EEEEEE;
            padding-bottom: 3%;
            padding-top: 3%;
        }

        .fa {
            color: #636b6f;
            padding: 15px;
            font-size: 20px;
            width: 25px;
            text-align: center;
            text-decoration: none !important;
            border-radius: 50%;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .links > span{
            font-family: 'Quicksand', sans-serif;
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        #footerContact{
            margin-top: 30px;
            margin-bottom: 30px;
        }
        #footerContact > span > strong {
            color: #2e2e29;
        }

        .username{
            font-family: 'Oswald', sans-serif;
            font-weight: bold;
            color: #05386B;
        }
    </style>

</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand logoText" href="{{ url('/') }}">
                    {{ config('app.name', 'Acceuil') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('parents.forum') }}">{{ __('Forum') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employés.espace_employe') }}">{{ __('Espace employé') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients.actualités') }}">{{ __('Actualités') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients.activités') }}">{{ __('Activités') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('parents.notifications') }}">{{ __('Notifications') }}</a>
                        </li>
                        @guest('employe')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employés.loginEmploye') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle username" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('employe')->user()->nom }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="my_footer">
        <div>
            <div class="links">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google-plus"></a>
                <a href="#" class="fa fa-linkedin"></a>
                <a href="#" class="fa fa-github"></a>
            </div>
            <div id="footerContact" class="links">
                <span class="contactLinks"><strong>Tel:</strong> &nbsp;&nbsp; +212-06 69 16 13 24</span>
                <span class="contactLinks"><strong>E-mail:</strong> &nbsp;&nbsp; gep.administration@gmail.com</span>
                <span class="contactLinks"><strong>Adresse:</strong> &nbsp;&nbsp; Massira 3, B, 559 Marrakech</span>
            </div>
            <div id="footerText" class="container text-center">
                Copyright &copy; GEP 2020
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</html>
