@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>📘 Libros SUNAT</h3>
    <a href="{{ route('libros.create') }}" class="btn btn-primary">➕ Nuevo Libro</a>
</div>

{{-- Filtros --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('libros.index') }}" method="GET" class="row g-2">
            
            <div class="col-md-3">
                <label>Periodo (AAAAMM)</label>
                <input type="text" name="periodo" class="form-control" value="{{ $periodo }}">
            </div>

            <div class="col-md-3">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="">Todos</option>
                    <option value="pendiente"   {{ $estado=='pendiente'?'selected':'' }}>Pendiente</option>
                    <option value="enviado"     {{ $estado=='enviado'?'selected':'' }}>Enviado</option>
                    <option value="observado"   {{ $estado=='observado'?'selected':'' }}>Observado</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-success w-100">🔍 Filtrar</button>
            </div>

        </form>
    </div>
</div>

{{-- Tabla --}}
<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Periodo</th>
                    <th>Estado</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
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

                    <td>
                        @if($libro->archivo)
                            <a href="/libros/{{ $libro->archivo }}" target="_blank" class="btn btn-sm btn-info">
                                📄 Ver TXT
                            </a>
                        @else
                            <span class="text-muted">Sin archivo</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('libros.edit', $libro) }}" class="btn btn-sm btn-primary">✏ Editar</a>

                        <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar libro?')">🗑 Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay libros registrados.</td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
