<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Sistema Híbrido')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background: #f4f6fa;
            font-family: "Nunito", sans-serif;
        }

        /* NAVBAR */
        .navbar-dark {
            background: #003b7a !important;
        }

        /* SIDEBAR */
        .sidebar {
            background: #ffffff;
            min-height: 100vh;
            border-right: 3px solid #ff7c00;
        }

        .sidebar .list-group-item {
            border: none;
            padding: 14px 20px;
            font-size: 15px;
            font-weight: 600;
            color: #003b7a;
            display: flex;
            align-items: center;
            transition: 0.25s;
            background: transparent;
        }

        .sidebar .list-group-item:hover {
            background: #003b7a;
            color: #fff;
            border-left: 8px solid #ff7c00;
            padding-left: 25px;
        }

        .sidebar .active {
            background: #003b7a !important;
            color: #fff !important;
            border-left: 8px solid #ff7c00;
        }

        /* CONTENIDO */
        .content-wrapper {
            padding: 35px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ auth()->check() ? route('dashboard') : url('/') }}">
            Sistema Híbrido
        </a>

        <div class="d-flex align-items-center">

            {{-- Usuario Autenticado --}}
            @auth
                <span class="text-white fw-semibold me-3">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm" style="background:#ff7c00; color:white; font-weight:bold;">
                        Cerrar sesión
                    </button>
                </form>
            @endauth

            {{-- Invitado --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-light btn-sm fw-bold">
                    Ingresar
                </a>
            @endguest

        </div>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SOLO SI EL USUARIO ESTÁ LOGUEADO --}}
        @auth
            <!-- SIDEBAR -->
            <div class="col-md-2 sidebar p-0">
                <div class="list-group list-group-flush">

                    <a href="{{ route('dashboard') }}"
                       class="list-group-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>

                    <a href="{{ route('usuarios.index') }}"
                       class="list-group-item {{ request()->is('usuarios*') ? 'active' : '' }}">
                        👥 Gestión de Usuarios
                    </a>

                    <a href="{{ route('roles.index') }}"
                       class="list-group-item {{ request()->is('roles*') ? 'active' : '' }}">
                        🔐 Gestión de Roles
                    </a>

                    <a href="{{ route('clientes.index') }}"
                       class="list-group-item {{ request()->is('clientes*') ? 'active' : '' }}">
                        📁 Clientes / Proveedores
                    </a>

                    <a href="{{ route('empleados.index') }}"
                       class="list-group-item {{ request()->is('empleados*') ? 'active' : '' }}">
                        👤 Empleados
                    </a>

                    <a href="/planillas"
                       class="list-group-item {{ request()->is('planillas*') ? 'active' : '' }}">
                        📑 Planillas
                    </a>

                    <a href="/libros"
                       class="list-group-item {{ request()->is('libros*') ? 'active' : '' }}">
                        🧾 Libros SUNAT
                    </a>

                    <a href="/constancias"
                       class="list-group-item {{ request()->is('constancias*') ? 'active' : '' }}">
                        📄 Constancias SUNAT
                    </a>

                    <a href="{{ route('consultas.index') }}"
                    class="list-group-item {{ request()->is('consultas*') ? 'active' : '' }}">
                        🧐 Consultas SUNAT
                    </a>

                    <a href="/reportes"
                       class="list-group-item {{ request()->is('reportes*') ? 'active' : '' }}">
                        📈 Reportes del Día
                    </a>

                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="col-md-10 content-wrapper">
                @yield('content')
            </div>
        @endauth

        {{-- PÁGINAS DE LOGIN / REGISTER --}}
        @guest
            <div class="col-md-12 content-wrapper">
                @yield('content')
            </div>
        @endguest

    </div>
</div>

</body>
</html>
