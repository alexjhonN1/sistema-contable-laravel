@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Crear Usuario</h3>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="role_id" class="form-control" required>
                @foreach($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
