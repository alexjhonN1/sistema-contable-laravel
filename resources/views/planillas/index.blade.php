@extends('layouts.app')

@section('title','Generar Planilla')

@section('content')
<div class="container">

    <h3 class="fw-bold mb-4" style="color:#003b7a;">Generar Planilla Mensual</h3>

    <div class="card shadow-sm p-4">

        <form action="{{ route('planillas.generar') }}" method="POST">
            @csrf

            <div class="row g-3">

                <!-- Empresa -->
                <div class="col-md-6">
                    <label class="fw-bold">Empresa (RUC):</label>
                    <select name="cliente_id" id="cliente_id" class="form-select" required>
                        <option value="">Seleccione empresa</option>
                        @foreach($clientes as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->ruc }} — {{ $c->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Mes -->
                <div class="col-md-4">
                    <label class="fw-bold">Mes:</label>
                    <input type="month" class="form-control" name="mes" required>
                </div>

                <!-- Botón generar -->
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-warning fw-bold w-100">Generar</button>
                </div>

            </div>

        </form>

        <!-- Botón historial -->
        <div class="mt-4 text-end">
            <a id="btnHistorial" href="#" class="btn btn-primary fw-bold disabled">
                📁 Ver historial de esta empresa
            </a>
        </div>

    </div>

</div>

<!-- SCRIPT PARA CAMBIAR LA RUTA DEL BOTÓN -->
<script>
document.getElementById('cliente_id').addEventListener('change', function() {
    const empresaID = this.value;
    const boton = document.getElementById('btnHistorial');

    if (empresaID) {
        boton.classList.remove('disabled');
        boton.href = "/planillas/historial/cliente/" + empresaID;
    } else {
        boton.classList.add('disabled');
        boton.href = "#";
    }
});
</script>

@endsection
