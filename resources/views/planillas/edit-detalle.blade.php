@extends('layouts.app')

@section('title', 'Editar Detalle de Planilla')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4" style="color:#004aad;">
        Editar Detalle del Trabajador
    </h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold">
                {{ $detalle->empleado->nombre_completo }}
                <span class="text-muted">({{ $detalle->empleado->numero_documento }})</span>
            </h5>

            <form action="{{ route('planillas.detalle.actualizar', $detalle->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Días</label>
                        <input type="number" name="dias" value="{{ $detalle->dias }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Ingresos</label>
                        <input type="number" step="0.01" name="ingresos" value="{{ $detalle->ingresos }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Descuentos</label>
                        <input type="number" step="0.01" name="descuentos" value="{{ $detalle->descuentos }}" class="form-control" required>
                    </div>

                </div>

                <hr>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Aporte Trabajador</label>
                        <input type="number" step="0.01" name="aporte_trabajador" value="{{ $detalle->aporte_trabajador }}" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Aporte Empleador</label>
                        <input type="number" step="0.01" name="aporte_empleador" value="{{ $detalle->aporte_empleador }}" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Neto a Pagar</label>
                        <input type="number" step="0.01" name="neto_pagar" value="{{ $detalle->neto_pagar }}" class="form-control">
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('planillas.show', $detalle->planilla_id) }}" class="btn btn-secondary">
                        ← Cancelar
                    </a>

                    <button class="btn btn-success fw-bold">Guardar Cambios</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
