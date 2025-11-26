@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Rol</h3>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre del rol</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ $role->nombre }}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
