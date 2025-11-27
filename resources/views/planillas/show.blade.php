@extends('layouts.app')

@section('title', 'Planilla Generada')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4" style="color:#004aad;">
        Planilla del Mes: {{ $planilla->mes }}
    </h2>

    <!-- BOTÓN DESCARGAR PDF -->
    <a href="{{ route('planillas.pdf', $planilla->id) }}"
       class="btn btn-danger mb-3 fw-bold">
        📄 Descargar PDF
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold mb-3">
                Empresa: {{ $planilla->cliente->nombre }}
                (RUC: {{ $planilla->cliente->ruc }})
            </h5>

            <!-- NAV -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold"
                            id="trabajadores-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#trabajadores"
                            type="button">
                        Trabajadores
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold"
                            id="pensionistas-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#pensionistas"
                            type="button">
                        Pensionistas
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold"
                            id="independientes-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#independientes"
                            type="button">
                        Independientes
                    </button>
                </li>

            </ul>

            <div class="tab-content">

                <!-- TAB TRABAJADORES -->
                <div class="tab-pane fade show active" id="trabajadores" role="tabpanel">

                    <h5 class="fw-bold mb-3 text-primary">Trabajadores</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-white" style="background:#004aad;">
                                <tr>
                                    <th>Documento</th>
                                    <th>Empleado</th>
                                    <th>Días</th>
                                    <th>Ingresos</th>
                                    <th>Descuentos</th>
                                    <th>Aporte Trab.</th>
                                    <th>Neto Pagar</th>
                                    <th>Aporte Empl.</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalles->where('tipo', 'trabajador') as $d)
                                <tr>
                                    <td>{{ $d->empleado->numero_documento }}</td>
                                    <td>{{ $d->empleado->nombre_completo }}</td>
                                    <td>{{ $d->dias }}</td>
                                    <td>S/ {{ number_format($d->ingresos,2) }}</td>
                                    <td>S/ {{ number_format($d->descuentos,2) }}</td>
                                    <td>S/ {{ number_format($d->aporte_trabajador,2) }}</td>
                                    <td class="fw-bold">S/ {{ number_format($d->neto_pagar,2) }}</td>
                                    <td>S/ {{ number_format($d->aporte_empleador,2) }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('planillas.detalle.editar', $d->id) }}"
                                           class="btn btn-sm btn-warning">
                                            ✏ Editar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- TAB PENSIONISTAS -->
                <div class="tab-pane fade" id="pensionistas" role="tabpanel">

                    <h5 class="fw-bold mb-3 text-primary">Pensionistas</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-white" style="background:#004aad;">
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Ingresos</th>
                                    <th>Aporte Trab.</th>
                                    <th>Neto</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalles->where('tipo', 'pensionado') as $d)
                                <tr>
                                    <td>{{ $d->empleado->numero_documento }}</td>
                                    <td>{{ $d->empleado->nombre_completo }}</td>
                                    <td>S/ {{ number_format($d->ingresos,2) }}</td>
                                    <td>S/ {{ number_format($d->aporte_trabajador,2) }}</td>
                                    <td class="fw-bold">S/ {{ number_format($d->neto_pagar,2) }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('planillas.detalle.editar', $d->id) }}"
                                           class="btn btn-sm btn-warning">
                                            ✏ Editar
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- TAB INDEPENDIENTES -->
                <div class="tab-pane fade" id="independientes" role="tabpanel">

                    <h5 class="fw-bold mb-3 text-primary">Independientes</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-white" style="background:#004aad;">
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Ingresos</th>
                                    <th>Neto</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalles->where('tipo', 'independiente') as $d)
                                <tr>
                                    <td>{{ $d->empleado->numero_documento }}</td>
                                    <td>{{ $d->empleado->nombre_completo }}</td>
                                    <td>S/ {{ number_format($d->ingresos,2) }}</td>
                                    <td class="fw-bold">S/ {{ number_format($d->neto_pagar,2) }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('planillas.detalle.editar', $d->id) }}"
                                           class="btn btn-sm btn-warning">
                                            ✏ Editar
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <a href="{{ route('planillas.index') }}" class="btn btn-secondary mt-3">
                ← Volver
            </a>

        </div>
    </div>

</div>
@endsection
