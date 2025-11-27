@extends('layouts.app')

@section('title', 'Registrar Cliente')

@section('content')

<style>
    .form-card {
        border-radius: 14px;
        border: none;
        background: white;
        padding: 30px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.10);
    }

    .title-section {
        font-size: 26px;
        font-weight: 800;
        color: #003b7a;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 700;
        color: #003b7a;
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px 18px;
        border: none;
    }

    .btn-orange:hover {
        background: #e56f00;
        color: white;
    }

    .btn-gray {
        background: #6c757d;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 18px;
        border: none;
    }

    .btn-gray:hover {
        background: #5a6268;
    }

    .hr-soft {
        margin: 20px 0;
        border: none;
        border-top: 2px solid #eef0f4;
    }
</style>

<div class="container">

    <h4 class="title-section">Registrar Cliente / Proveedor</h4>

    <div class="form-card">

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <!-- Nombre -->
                <div class="col-md-6">
                    <label class="form-label">Nombre o Razón Social</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- RUC -->
                <div class="col-md-3">
                    <label class="form-label">RUC</label>
                    <input type="text" name="ruc" class="form-control" maxlength="11" required>
                </div>

                <!-- DNI -->
                <div class="col-md-3">
                    <label class="form-label">DNI</label>
                    <input type="text" name="dni" class="form-control" maxlength="8">
                </div>

            </div>

            <hr class="hr-soft">

            <div class="row g-3">

                <!-- Clave SOL -->
                <div class="col-md-3">
                    <label class="form-label">Clave SOL</label>
                    <input type="text" name="clave_sol" class="form-control">
                </div>

                <!-- Password SOL -->
                <div class="col-md-3">
                    <label class="form-label">Contraseña SOL</label>
                    <input type="text" name="password_sol" class="form-control">
                </div>

                <!-- Grupo -->
                <div class="col-md-3">
                    <label class="form-label">Grupo</label>
                    <input type="text" name="grupo" class="form-control" placeholder="Ej: Salud, Educación, etc.">
                </div>

                <!-- Estado -->
                <div class="col-md-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="urgente">Urgente</option>
                        <option value="proxima_fecha" selected>Próxima Fecha</option>
                        <option value="concluido">Concluido</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('clientes.index') }}" class="btn-gray">Volver</a>
                <button class="btn-orange">Guardar Cliente</button>
            </div>

        </form>

    </div>

</div>

@endsection
