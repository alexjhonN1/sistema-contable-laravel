@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Usuario</h3>

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input name="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label>Nueva Contraseña (opcional)</label>
            <input name="password" type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="role_id" class="form-control">
                @foreach($roles as $rol)
                <option value="{{ $rol->id }}" 
                        @if($usuario->role_id == $rol->id) selected @endif>
                    {{ $rol->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
