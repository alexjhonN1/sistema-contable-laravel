@extends('layouts.app')

@section('title', 'Empleados')

@section('content')

<style>
    .title-page {
        color: #003b7a;
        font-weight: 800;
        font-size: 30px;
        margin-bottom: 10px;
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: 700;
        border-radius: 8px;
        padding: 10px 18px;
        transition: 0.3s;
    }
    .btn-orange:hover {
        background: #e56f00;
        color:white;
    }

    .card-custom {
        border-radius: 14px;
        border: none;
        box-shadow: 0px 4px 14px rgba(0,0,0,0.12);
    }

    thead tr {
        background: #003b7a;
    }
    thead tr th {
        color: white;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .mini-text {
        font-size: 13px;
        color: #6c757d;
        font-weight: 600;
    }

    .badge-afp {
        background: #004aad !important;
        font-size: 12px;
    }
    .badge-onp {
        background: #ff7c00 !important;
        font-size: 12px;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background: #f5f8ff;
    }

    .btn-sm-custom {
        padding: 5px 10px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 6px;
    }

</style>


<div class="container">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-page">
            Empleados
        </h2>

        <a href="{{ route('empleados.create') }}" class="btn btn-orange">
            + Nuevo Empleado
        </a>
    </div>


    <!-- CARD PRINCIPAL -->
    <div class="card card-custom">
        <div class="card-body">

            <!-- TABLA DE EMPLEADOS -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Documento</th>
                            <th>Empleado</th>
                            <th>Cargo</th>
                            <th>Pensión</th>
                            <th>Sueldo</th>
                            <th>AF</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($empleados as $e)
                        <tr>

                            <!-- EMPRESA -->
                            <td>
                                <strong>{{ $e->cliente->nombre }}</strong>
                                <div class="mini-text">{{ $e->cliente->ruc }}</div>
                            </td>

                            <!-- DOCUMENTO -->
                            <td>
                                <strong>{{ $e->tipo_documento }}</strong><br>
                                <span class="mini-text">{{ $e->numero_documento }}</span>
                            </td>

                            <!-- EMPLEADO -->
                            <td>
                                <strong>{{ $e->nombre_completo }}</strong>
                            </td>

                            <!-- CARGO -->
                            <td>{{ $e->cargo ?? '-' }}</td>

                            <!-- PENSIÓN -->
                            <td>
                                @if($e->pension == 'AFP')
                                    <span class="badge badge-afp">AFP</span>
                                @else
                                    <span class="badge badge-onp">ONP</span>
                                @endif
                            </td>

                            <!-- SUELDO -->
                            <td>S/ {{ number_format($e->sueldo, 2) }}</td>

                            <!-- ASIGNACIÓN FAMILIAR -->
                            <td>
                                @if($e->asignacion_familiar)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>

                            <!-- OPCIONES -->
                            <td class="text-center">

                                <a href="{{ route('empleados.edit', $e->id) }}"
                                   class="btn btn-primary btn-sm-custom">
                                    ✏ Editar
                                </a>

                                <form action="{{ route('empleados.destroy', $e->id) }}" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Eliminar empleado?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm-custom">
                                        🗑 Eliminar
                                    </button>
                                </form>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No hay empleados registrados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- PAGINACIÓN -->
            <div class="mt-3">
                {{ $empleados->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
