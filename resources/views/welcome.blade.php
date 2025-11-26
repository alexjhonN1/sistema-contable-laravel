<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Bootstrap + JS generado por Laravel UI -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Laravel UI</a>

        <div class="d-flex">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Registro</a>
            @else
                <span class="me-3">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4">Bienvenido al Sistema Híbrido Contable</h1>
    <p class="lead">Laravel 12 + Laravel UI + Bootstrap funcionando correctamente.</p>
</div>

</body>
</html>
