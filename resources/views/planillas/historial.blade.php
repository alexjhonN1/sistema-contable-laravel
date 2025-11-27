@extends('layouts.app')

@section('title', 'Historial de Planillas')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color:#003b7a;">Historial de Planillas</h3>

        <a href="{{ route('planillas.index') }}" class="btn btn-secondary fw-bold">
            ← Volver
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-white" style="background:#004aad;">
                        <tr>
                            <th>ID</th>
                            <th>Empresa</th>
                            <th>RUC</th>
                            <th>Mes</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($planillas as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->cliente->nombre }}</td>
                                <td>{{ $p->cliente->ruc }}</td>
                                <td>{{ $p->mes }}</td>

                                <td class="text-center">

                                    <!-- Ver planilla -->
                                    <a href="{{ route('planillas.show', $p->id) }}"
                                       class="btn btn-sm btn-primary fw-bold">
                                        👁 Ver
                                    </a>

                                    <!-- Descargar PDF -->
                                    <a href="{{ route('planillas.pdf', $p->id) }}"
                                       class="btn btn-sm btn-danger fw-bold"
                                       target="_blank">
                                        📄 PDF
                                    </a>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">
                                    No hay planillas generadas aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
