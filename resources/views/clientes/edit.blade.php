@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">Editar Cliente / Proveedor</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nombre o Razón Social</label>
                        <input type="text" name="nombre" class="form-control"
                               value="{{ $cliente->nombre }}" required>
                    </div>

                    <!-- RUC -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">RUC</label>
                        <input type="text" name="ruc" class="form-control" maxlength="11"
                               value="{{ $cliente->ruc }}" required>
                    </div>

                    <!-- DNI opcional -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">DNI</label>
                        <input type="text" name="dni" class="form-control" maxlength="8"
                               value="{{ $cliente->dni }}">
                    </div>

                    <!-- Clave SOL -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Clave SOL</label>
                        <input type="text" name="clave_sol" class="form-control"
                               value="{{ $cliente->clave_sol }}">
                    </div>

                    <!-- Password SOL -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Contraseña SOL</label>
                        <input type="text" name="password_sol" class="form-control"
                               value="{{ $cliente->password_sol }}">
                    </div>

                    <!-- Grupo -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Grupo</label>
                        <input type="text" name="grupo" class="form-control"
                               value="{{ $cliente->grupo }}">
                    </div>

                    <!-- Estado -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="urgente"        @selected($cliente->estado=='urgente')>Urgente</option>
                            <option value="proxima_fecha" @selected($cliente->estado=='proxima_fecha')>Próxima Fecha</option>
                            <option value="concluido"      @selected($cliente->estado=='concluido')>Concluido</option>
                            <option value="inactivo"       @selected($cliente->estado=='inactivo')>Inactivo</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button class="btn btn-primary">Guardar Cambios</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
