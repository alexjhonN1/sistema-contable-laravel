@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Gestión de Usuarios</h3>

    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">
        ➕ Nuevo Usuario
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th width="200">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->role->nombre }}</td>

                <td>
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('usuarios.destroy', $usuario) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar usuario?')">
                            Eliminar
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
