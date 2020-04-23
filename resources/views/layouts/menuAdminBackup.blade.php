<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--    <!-- Scripts -->--}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{'Wonderful'}}
            </a>
            {{--            reportes--}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Reportes<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        {{--                        <a class="dropdown-item btn btn-light btn-sm dropdown-item" href="">--}}
                        {{--                        </a>--}}
                        <a href="/reportes/articulos" class="btn btn-outline-secondary  btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">1.- Productos mas vendidos por mes</a>
                        <a href="/reportes/clientes" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">2.- Clientes que mas compraron por anio</a>
                        <a href="/reportes/categorias" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">3.- Ventas por Departamento</a>
                        <a href="/reportes/categories_promedio" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">4.- Promedio de productos vendidos por departamento</a>
                        <a href="/reportes/colaboradores/ordenes_despachados" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">7.- Lista de colaboradores y ordenes que despacharon</a>
                        <a href="/reportes/usuarios_verificadores" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">8.- Lista de verificadores con sus cantidades de ordenes entregados</a>
                        <a href="/reportes/raitings/{{1}}/raiting_comentarios_articulos" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">9.- Raiting y comentarios de los productos</a>

                        {{--                        dev wonderful--}}
                        {{--                        <a href="/testChart" class="btn btn-outline-primary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">Test Chart</a>--}}
                    </div>
                </li>
            </ul>

            {{--            reportes estadisticos con tortas--}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Reportes Estadisticos<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a href="/reportes/categories_promedio_chart" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">4.- Promedio de productos vendidos por departamento</a>
                        <a href="/reportes/ventas_ciudades" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">5.- Promedio de ventas por ciudad</a>
                        <a href="/reportes/ventas/{{1}}/articulos_promedio_ventas_ciudades" class="btn btn-outline-secondary btn-sm dropdown" tabindex="-1" role="button" aria-disabled="true">6.- Promedio de productos por ciudades</a>
                    </div>
                </li>
            </ul>
            {{--                fin menu reportes--}}

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
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
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
</body>
{{--wonderful scripts bar charts --}}
<script src="{{asset('js/chartjs-2.7.1/Chart.min.js')}}"></script>
@yield('scriptsBarChart')

{{--wonderful scripts --}}
{{-- <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('js/select2/select2.min.js')}}"></script>
{{--<script src="{{ asset('js/app.js') }}" defer></script> --}}
{{--<script src="{{ asset('js/bootstrap.js') }}" defer></script>--}}
@yield('scripts')

</html>
