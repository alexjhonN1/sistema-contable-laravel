@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Gestión de Roles</h3>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Nuevo Rol</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->nombre }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('roles.destroy', $role) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar rol?')">
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
