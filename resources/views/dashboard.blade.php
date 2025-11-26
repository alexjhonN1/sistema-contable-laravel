<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema Híbrido</a>

        <div class="d-flex">
            <span class="text-white me-3">{{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-white border-end vh-100 p-0">

            <div class="list-group list-group-flush">

                <a href="/dashboard" class="list-group-item list-group-item-action">
                    📊 Dashboard
                </a>

                <a href="/usuarios" class="list-group-item list-group-item-action">
                    👥 Gestión de Usuarios
                </a>

                <a href="/roles" class="list-group-item list-group-item-action">
                    🔐 Gestión de Roles
                </a>
4
                <a href="#" class="list-group-item list-group-item-action">
                    📁 Clientes
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    🧾 Libros SUNAT
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    📄 Constancias SUNAT
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    🧮 Reportes del Día
                </a>

            </div>

        </div>

        <!-- Main content -->
        <div class="col-md-10 p-4">

            <h2 class="mb-4">Bienvenido, SuperAdmin</h2>

            <div class="alert alert-info">
                Este es tu panel principal. Desde aquí podrás gestionar todo el Sistema Híbrido Contable.
            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text">Administrar cuentas y permisos.</p>
                            <a href="/usuarios" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Roles</h5>
                            <p class="card-text">Gestionar roles y autorizaciones.</p>
                            <a href="/roles" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Clientes</h5>
                            <p class="card-text">Registrar y gestionar clientes.</p>
                            <a href="#" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
