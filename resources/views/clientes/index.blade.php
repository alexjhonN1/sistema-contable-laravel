@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">Gestión de Clientes / Proveedores</h4>

    <!-- FILTROS -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <form class="row g-3" method="GET">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Nombre o Razón Social" value="{{ $busqueda }}">
                </div>

                <div class="col-md-3">
                    <input type="text" name="search_ruc" class="form-control" placeholder="RUC">
                </div>

                <div class="col-md-3">
                    <input type="text" name="search_dni" class="form-control" placeholder="DNI">
                </div>

                <div class="col-md-2">
                    <a href="{{ route('clientes.create') }}" class="btn btn-success w-100">
                        + Registrar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- BOTONES ÚLTIMO DÍGITO -->
    <div class="mb-3">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-sm {{ $ultimo === null ? 'active' : '' }}">Todos</a>

        @for($i = 0; $i <= 9; $i++)
            <a href="{{ route('clientes.index', ['ultimo' => $i]) }}"
               class="btn btn-outline-primary btn-sm {{ $ultimo == $i ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>

    <!-- TABLA -->
    <table class="table table-hover shadow-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>RUC</th>
                <th>DNI</th>
                <th>Grupo</th>
                <th>Estado</th>
                <th width="140">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($clientes as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->ruc }}</td>
                <td>{{ $c->dni ?? '-' }}</td>
                <td>{{ $c->grupo ?? '-' }}</td>

                <td>
                    @if($c->estado === 'urgente')
                        <span class="badge text-bg-danger">urgente</span>
                    @elseif($c->estado === 'proxima_fecha')
                        <span class="badge text-bg-warning">próxima fecha</span>
                    @elseif($c->estado === 'concluido')
                        <span class="badge text-bg-success">concluido</span>
                    @else
                        <span class="badge text-bg-secondary">inactivo</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('clientes.edit', $c) }}" class="btn btn-sm btn-primary">✏</a>

                    <form action="{{ route('clientes.destroy', $c) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
