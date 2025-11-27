@extends('layouts.app')

@section('title', 'Libros SUNAT')

@section('content')
<div class="container">

    {{-- Título y botón --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color:#004aad;">📘 Libros SUNAT</h3>

        <a href="{{ route('libros.create') }}" 
           class="btn fw-bold" 
           style="background:#ffbe00; color:#000;">
            ➕ Nuevo Libro
        </a>
    </div>

    {{-- Filtros --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form action="{{ route('libros.index') }}" method="GET" class="row g-3">

                <div class="col-md-4">
                    <label class="fw-bold" style="color:#003b7a;">Periodo (AAAAMM)</label>
                    <input type="text" name="periodo" class="form-control" value="{{ $periodo }}">
                </div>

                <div class="col-md-4">
                    <label class="fw-bold" style="color:#003b7a;">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="pendiente" {{ $estado=='pendiente'?'selected':'' }}>Pendiente</option>
                        <option value="enviado" {{ $estado=='enviado'?'selected':'' }}>Enviado</option>
                        <option value="observado" {{ $estado=='observado'?'selected':'' }}>Observado</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn fw-bold w-100" style="background:#004aad; color:white;">
                        🔍 Filtrar
                    </button>
                </div>

            </form>

        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="text-white" style="background:#004aad;">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>Archivo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($libros as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->cliente->nombre }}</td>
                        <td>{{ ucfirst($libro->tipo_libro) }}</td>
                        <td>{{ $libro->periodo }}</td>

                        <td>
                            @if($libro->estado == 'pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($libro->estado == 'enviado')
                                <span class="badge bg-success">Enviado</span>
                            @else
                                <span class="badge bg-danger">Observado</span>
                            @endif
                        </td>

                        {{-- Archivo --}}
                        <td>
                            @if($libro->archivo)
                                <a href="/libros/{{ $libro->archivo }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-info text-white">
                                    📄 Ver TXT
                                </a>
                            @else
                                <span class="text-muted">Sin archivo</span>
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td class="text-center">

                            <a href="{{ route('libros.edit', $libro) }}" 
                               class="btn btn-sm fw-bold"
                               style="background:#ffbe00;">
                                ✏ Editar
                            </a>

                            <form action="{{ route('libros.destroy', $libro) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger fw-bold"
                                        onclick="return confirm('¿Eliminar libro?')">
                                    🗑 Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No hay libros registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
