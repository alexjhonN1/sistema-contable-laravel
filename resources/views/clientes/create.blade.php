@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">Registrar Cliente / Proveedor</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nombre o Razón Social</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <!-- RUC -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">RUC</label>
                        <input type="text" name="ruc" class="form-control" maxlength="11" required>
                    </div>

                    <!-- DNI opcional -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">DNI</label>
                        <input type="text" name="dni" class="form-control" maxlength="8">
                    </div>

                    <!-- Clave SOL -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Clave SOL</label>
                        <input type="text" name="clave_sol" class="form-control">
                    </div>

                    <!-- Password SOL -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Contraseña SOL</label>
                        <input type="text" name="password_sol" class="form-control">
                    </div>

                    <!-- Grupo -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Grupo</label>
                        <input type="text" name="grupo" class="form-control" placeholder="Ej: Salud, Educación, etc.">
                    </div>

                    <!-- Estado -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="urgente" class="text-danger">Urgente</option>
                            <option value="proxima_fecha" selected>Próxima Fecha</option>
                            <option value="concluido">Concluido</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
                    <button class="btn btn-success">Registrar Cliente</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
