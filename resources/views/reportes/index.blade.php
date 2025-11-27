@extends('layouts.app')

@section('content')

<h2 class="mb-4">🧮 Reporte del Día – {{ $hoy }}</h2>

<!-- BOTONES PDF / EXCEL -->
<div class="mb-4">
    <a href="{{ route('reportes.pdf') }}" class="btn btn-danger me-2">
        📄 Descargar PDF
    </a>

    <a href="{{ route('reportes.excel') }}" class="btn btn-success">
        📊 Descargar Excel
    </a>
</div>

<div class="row">

    <!-- Total libros -->
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm text-center p-3">
            <h4>{{ $totalLibrosHoy }}</h4>
            <p class="text-muted m-0">Libros generados hoy</p>
        </div>
    </div>

    <!-- Enviados -->
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm text-center p-3">
            <h4 class="text-success">{{ $enviadosHoy }}</h4>
            <p class="text-muted m-0">Enviados</p>
        </div>
    </div>

    <!-- Pendientes -->
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm text-center p-3">
            <h4 class="text-warning">{{ $pendientesHoy }}</h4>
            <p class="text-muted m-0">Pendientes</p>
        </div>
    </div>

    <!-- Observados -->
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm text-center p-3">
            <h4 class="text-danger">{{ $observadosHoy }}</h4>
            <p class="text-muted m-0">Observados</p>
        </div>
    </div>

</div>

<!-- Clientes atendidos -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="m-0">👥 Clientes atendidos hoy: 
            <strong>{{ $clientesAtendidos }}</strong>
        </h5>
    </div>
</div>

<!-- Gráfico -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">📊 Estadísticas del Día</h5>
        <canvas id="graficoEstados" height="120"></canvas>
    </div>
</div>

<!-- Detalle -->
<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <h5 class="mb-3">📋 Detalle de actividades del día</h5>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Periodo</th>
                <th>Estado</th>
                <th>Usuario</th>
            </tr>
            </thead>

            <tbody>
            @forelse($detalle as $item)
                <tr>
                    <td>{{ $item->created_at->format('H:i') }}</td>
                    <td>{{ $item->cliente->nombre }}</td>
                    <td>{{ ucfirst($item->tipo_libro) }}</td>
                    <td>{{ $item->periodo }}</td>

                    <td>
                        <span class="badge 
                            @if($item->estado=='pendiente') bg-warning text-dark
                            @elseif($item->estado=='enviado') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($item->estado) }}
                        </span>
                    </td>

                    <td>{{ $item->usuario->name ?? 'Sistema' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay actividades registradas hoy.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection

