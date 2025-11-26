@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Crear Rol</h3>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre del rol</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
