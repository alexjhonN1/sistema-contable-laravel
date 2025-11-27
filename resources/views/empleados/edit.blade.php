@extends('layouts.app')

@section('title', 'Editar Empleado')

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
        border: 1px solid #d2dae6;
    }

    .form-input:focus, .form-select:focus {
        border-color: #004aad;
        box-shadow: 0 0 4px rgba(0, 74, 173, 0.4);
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        padding: 12px 24px;
        border: none;
        transition: 0.3s;
    }

    .btn-orange:hover {
        background: #e56f00;
    }

    .btn-gray {
        background: #6c757d;
        border: none;
        color: white;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-gray:hover {
        background: #5a6268;
    }

    .checkbox-label {
        font-weight: 700;
        margin-left: 12px;
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

    <h2 class="title-section">Editar Empleado</h2>

    <div class="form-card">

        <form method="POST" action="{{ route('empleados.update', $empleado->id) }}">
            @csrf
            @method('PUT')

            <!-- 🌟 PESTAÑAS DE TIPO EMPLEADO -->
            <div class="mb-4">
                <label class="form-label d-block">Tipo de Empleado</label>

                <div class="d-flex">
                    <button type="button" class="tab-button {{ $empleado->tipo=='trabajador' ? 'active' : '' }}" data-value="trabajador">
                        Trabajador
                    </button>

                    <button type="button" class="tab-button {{ $empleado->tipo=='pensionado' ? 'active' : '' }}" data-value="pensionado">
                        Pensionado
                    </button>

                    <button type="button" class="tab-button {{ $empleado->tipo=='independiente' ? 'active' : '' }}" data-value="independiente">
                        Independiente
                    </button>
                </div>

                <input type="hidden" name="tipo" id="tipoEmpleado" value="{{ $empleado->tipo }}">
            </div>

            <div class="row g-4">

                <!-- Empresa -->
                <div class="col-md-6">
                    <label class="form-label">Empresa (Cliente)</label>
                    <select name="cliente_id" class="form-select form-input" required>
                        @foreach($clientes as $c)
                            <option value="{{ $c->id }}"
                                {{ $empleado->cliente_id == $c->id ? 'selected' : '' }}>
                                {{ $c->ruc }} - {{ $c->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo documento -->
                <div class="col-md-3">
                    <label class="form-label">Tipo de Documento</label>
                    <select name="tipo_documento" class="form-select form-input">
                        <option value="DNI" {{ $empleado->tipo_documento == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="Carnet Extranjería" {{ $empleado->tipo_documento == 'Carnet Extranjería' ? 'selected' : '' }}>
                            Carnet Extranjería
                        </option>
                    </select>
                </div>

                <!-- Número documento -->
                <div class="col-md-3">
                    <label class="form-label">Número de Documento</label>
                    <input type="text" name="numero_documento"
                           value="{{ $empleado->numero_documento }}"
                           class="form-control form-input" required>
                </div>

                <!-- Apellidos -->
                <div class="col-md-4">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno"
                           value="{{ $empleado->apellido_paterno }}"
                           class="form-control form-input" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="apellido_materno"
                           value="{{ $empleado->apellido_materno }}"
                           class="form-control form-input" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres"
                           value="{{ $empleado->nombres }}"
                           class="form-control form-input" required>
                </div>

                <!-- Fecha ingreso -->
                <div class="col-md-4">
                    <label class="form-label">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso"
                           value="{{ $empleado->fecha_ingreso }}"
                           class="form-control form-input" required>
                </div>

                <!-- Cargo -->
                <div class="col-md-4">
                    <label class="form-label">Cargo</label>
                    <input type="text" name="cargo"
                           value="{{ $empleado->cargo }}"
                           class="form-control form-input">
                </div>

                <!-- Sueldo -->
                <div class="col-md-4">
                    <label class="form-label">Sueldo</label>
                    <input type="number" step="0.01" name="sueldo"
                           value="{{ $empleado->sueldo }}"
                           class="form-control form-input" required>
                </div>

                <!-- Pension -->
                <div class="col-md-4">
                    <label class="form-label">Régimen Pensionario</label>
                    <select name="pension" class="form-select form-input">
                        <option value="ONP" {{ $empleado->pension == 'ONP' ? 'selected' : '' }}>ONP</option>
                        <option value="AFP" {{ $empleado->pension == 'AFP' ? 'selected' : '' }}>AFP</option>
                    </select>
                </div>

                <!-- Asig. Familiar -->
                <div class="col-md-4 d-flex align-items-center mt-4">
                    <input type="checkbox" name="asignacion_familiar" value="1"
                           {{ $empleado->asignacion_familiar ? 'checked' : '' }}
                           style="transform: scale(1.4); cursor:pointer;">
                    <label class="checkbox-label">Asignación Familiar</label>
                </div>

            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('empleados.index') }}" class="btn-gray">Cancelar</a>
                <button class="btn-orange">Actualizar Empleado</button>
            </div>

        </form>

    </div>

</div>

<!-- SCRIPT PARA ACTIVAR TABS -->
<script>
document.querySelectorAll(".tab-button").forEach(btn => {

    btn.addEventListener("click", function () {

        // limpiar
        document.querySelectorAll(".tab-button")
            .forEach(b => b.classList.remove("active"));

        // activar
        this.classList.add("active");

        // guardar valor en el input hidden
        document.getElementById("tipoEmpleado").value = this.dataset.value;
    });
});
</script>

@endsection
