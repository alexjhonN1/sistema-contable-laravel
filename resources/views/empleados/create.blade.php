@extends('layouts.app')

@section('title', 'Registrar Empleado')

@section('content')

<style>
    .form-card {
        background: white;
        border-radius: 14px;
        padding: 35px;
        box-shadow: 0px 4px 16px rgba(0,0,0,0.10);
        border: none;
    }

    .title-section {
        font-size: 28px;
        font-weight: 800;
        color: #003b7a;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 700;
        color: #003b7a;
    }

    .form-input, .form-select {
        border-radius: 10px !important;
        padding: 10px 14px;
        border: 1px solid #d0d7e4;
    }

    .form-input:focus, .form-select:focus {
        border-color: #004aad;
        box-shadow: 0 0 4px rgba(0, 74, 173, 0.3);
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        padding: 12px 25px;
        border: none;
        transition: 0.25s;
    }
    .btn-orange:hover { background: #e56f00; }

    .btn-back {
        background: #003b7a;
        color: white;
        border-radius: 10px;
        padding: 12px 25px;
        margin-right: 10px;
    }
    .btn-back:hover { background: #002e5e; }

    .checkbox-label {
        font-weight: 700;
        margin-left: 10px;
        color: #003b7a;
    }

    /* PESTAÑAS */
    .tab-button {
        border: none;
        background: #e7edf7;
        padding: 10px 22px;
        font-weight: 700;
        color: #003b7a;
        border-radius: 10px 10px 0 0;
        cursor: pointer;
        transition: 0.25s;
        margin-right: 5px;
    }

    .tab-button.active {
        background: #003b7a;
        color: white;
    }
</style>

<div class="container">

    <h2 class="title-section">Registrar Nuevo Empleado</h2>

    <div class="form-card">

        <form method="POST" action="{{ route('empleados.store') }}">
            @csrf

            <!-- 🌟 PESTAÑAS DE TIPO DE EMPLEADO -->
            <div class="mb-4">
                <label class="form-label d-block">Tipo de Empleado</label>

                <div class="d-flex">
                    <button type="button" class="tab-button active" data-value="trabajador">
                        Trabajador
                    </button>

                    <button type="button" class="tab-button" data-value="pensionado">
                        Pensionado
                    </button>

                    <button type="button" class="tab-button" data-value="independiente">
                        Independiente
                    </button>
                </div>

                <!-- Hidden para enviar al backend -->
                <input type="hidden" name="tipo" id="tipoEmpleado" value="trabajador">
            </div>

            <div class="row g-4">

                <!-- Empresa -->
                <div class="col-md-6">
                    <label class="form-label">Empresa (Cliente)</label>
                    <select name="cliente_id" class="form-select form-input" required>
                        <option value="">Seleccione la empresa</option>
                        @foreach($clientes as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->ruc }} - {{ $c->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo documento -->
                <div class="col-md-3">
                    <label class="form-label">Tipo de Documento</label>
                    <select name="tipo_documento" class="form-select form-input">
                        <option>DNI</option>
                        <option>Carnet Extranjería</option>
                    </select>
                </div>

                <!-- Número documento -->
                <div class="col-md-3">
                    <label class="form-label">Número de Documento</label>
                    <input type="text" name="numero_documento" class="form-control form-input" required>
                </div>

                <!-- Apellidos y nombres -->
                <div class="col-md-4">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control form-input" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="apellido_materno" class="form-control form-input" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control form-input" required>
                </div>

                <!-- Fecha ingreso -->
                <div class="col-md-4">
                    <label class="form-label">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control form-input" required>
                </div>

                <!-- Cargo -->
                <div class="col-md-4">
                    <label class="form-label">Cargo</label>
                    <input type="text" name="cargo" class="form-control form-input">
                </div>

                <!-- Sueldo -->
                <div class="col-md-4">
                    <label class="form-label">Sueldo</label>
                    <input type="number" step="0.01" name="sueldo" class="form-control form-input" required>
                </div>

                <!-- Pension -->
                <div class="col-md-4">
                    <label class="form-label">Régimen Pensionario</label>
                    <select name="pension" class="form-select form-input">
                        <option value="ONP">ONP</option>
                        <option value="AFP">AFP</option>
                    </select>
                </div>

                <!-- Asignación familiar -->
                <div class="col-md-4 d-flex align-items-center mt-4 pt-2">
                    <input type="checkbox" name="asignacion_familiar" value="1"
                           style="transform: scale(1.4); cursor:pointer;">
                    <label class="checkbox-label">Asignación Familiar</label>
                </div>

            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('empleados.index') }}" class="btn-back">Volver</a>
                <button class="btn-orange">Guardar Empleado</button>
            </div>

        </form>

    </div>

</div>

<!-- SCRIPT PARA MANEJAR LAS PESTAÑAS -->
<script>
document.querySelectorAll(".tab-button").forEach(btn => {
    btn.addEventListener("click", function () {

        // remover active de todos
        document.querySelectorAll(".tab-button")
            .forEach(b => b.classList.remove("active"));

        // activar el que se tocó
        this.classList.add("active");

        // actualizar hidden
        document.getElementById("tipoEmpleado").value = this.dataset.value;
    });
});
</script>

@endsection
