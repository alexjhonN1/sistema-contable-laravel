@extends('layouts.app')

@section('title','Planilla')

@section('content')

<style>
    .tabs a {
        padding: 10px 18px;
        font-weight: 700;
        color: #003b7a;
        border-bottom: 3px solid transparent;
        text-decoration: none;
    }
    .tabs a.active {
        color: #ff7c00;
        border-bottom: 3px solid #ff7c00;
    }
    .table-header {
        background:#003b7a;
        color:white;
        font-weight:bold;
    }
    .btn-edit {
        background:#ff7c00; color:white; border:none;
        padding:5px 12px; border-radius:5px;
    }
    .btn-edit:hover { background:#e56f00; color:white; }
    .badge-ok {
        background:#28a745; color:white; padding:5px 7px;
        border-radius:50%;
    }
</style>

<div class="container">

    <!-- Empresa -->
    <h4 class="fw-bold mb-3" style="color:#003b7a;">
        Planilla de {{ $planilla->cliente->nombre }}  
        (RUC: {{ $planilla->cliente->ruc }})  
        — {{ $planilla->mes }}
    </h4>

    <!-- Pestañas -->
    <div class="tabs mb-3">
        <a href="{{ route('planillas.ver', ['id'=>$planilla->id,'tipo'=>'trabajador']) }}"
           class="{{ $tipo=='trabajador'?'active':'' }}">
            Trabajadores
        </a>

        <a href="{{ route('planillas.ver', ['id'=>$planilla->id,'tipo'=>'pensionado']) }}"
           class="{{ $tipo=='pensionado'?'active':'' }}">
            Pensionados
        </a>

        <a href="{{ route('planillas.ver', ['id'=>$planilla->id,'tipo'=>'independiente']) }}"
           class="{{ $tipo=='independiente'?'active':'' }}">
            Independientes
        </a>
    </div>

    <!-- TABLA -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-header">
                <tr>
                    <th>Documento</th>
                    <th>Apellidos y Nombres</th>
                    <th>Días</th>
                    <th>Ingresos</th>
                    <th>Descuentos</th>
                    <th>Aporte Trab.</th>
                    <th>Neto</th>
                    <th>Aporte Empleador</th>
                    <th>Editar</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>

                @foreach($planilla->detalles->where('tipo',$tipo) as $d)
                <tr>
                    <td>{{ $d->empleado->numero_documento }}</td>
                    <td>{{ $d->empleado->nombre_completo }}</td>
                    <td>{{ $d->dias }}</td>
                    <td>{{ number_format($d->ingresos,2) }}</td>
                    <td>{{ number_format($d->descuentos,2) }}</td>
                    <td>{{ number_format($d->aporte_trabajador,2) }}</td>
                    <td>{{ number_format($d->neto_pagar,2) }}</td>
                    <td>{{ number_format($d->aporte_empleador,2) }}</td>

                    <td>
                        <a href="{{ route('planillas.detalle.edit',$d->id) }}"
                            class="btn-edit">✏</a>
                    </td>

                    <td class="text-center">
                        <span class="badge-ok">✔</span>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

@endsection
