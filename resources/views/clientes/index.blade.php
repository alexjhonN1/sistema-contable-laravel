@extends('layouts.app')

@section('title', 'Clientes')

@section('content')

<style>
    .title-page {
        font-size: 28px;
        font-weight: 800;
        color: #003b7a;
        margin-bottom: 20px;
    }

    .card-filter {
        border-radius: 12px;
        padding: 18px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        border-radius: 8px;
        font-weight: bold;
        border: none;
        transition: 0.3s;
    }

    .btn-orange:hover {
        background: #e56f00;
    }

    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .table-modern thead {
        background: #003b7a;
        color: white;
        font-weight: 700;
    }

    .table-modern tbody tr:hover {
        background: #f4f7ff;
    }

    .badge-modern {
        font-size: 13px;
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .badge-urgente {
        background: #ff4d4f;
        color: white;
    }

    .badge-proxima {
        background: #ffdd57;
        color: #7a5b00;
    }

    .badge-concluido {
        background: #28a745;
        color: white;
    }

    .badge-inactivo {
        background: #6c757d;
        color: white;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        border: none;
    }

    .btn-edit {
        background: #003b7a;
        color: white;
    }

    .btn-edit:hover {
        background: #002f63;
    }

    .btn-delete {
        background: #ff4d4f;
        color: white;
    }

    .btn-delete:hover {
        background: #d63d3f;
    }

    .btn-filter-active {
        background: #003b7a !important;
        color: white !important;
        border-radius: 6px;
    }

    .btn-num {
        font-weight: 700;
        border-radius: 6px;
    }
</style>

<div class="container">

    <!-- TÍTULO -->
    <h4 class="title-page">Gestión de Clientes / Proveedores</h4>

    <!-- FILTROS -->
    <div class="card card-filter mb-3">
        <form class="row g-3" method="GET">

            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                    placeholder="Nombre o Razón Social" value="{{ $busqueda }}">
            </div>

            <div class="col-md-3">
                <input type="text" name="search_ruc" class="form-control"
                    placeholder="RUC">
            </div>

            <div class="col-md-3">
                <input type="text" name="search_dni" class="form-control"
                    placeholder="DNI">
            </div>

            <!-- BOTÓN BUSCAR -->
            <div class="col-md-1 d-grid">
                <button class="btn btn-primary fw-bold" style="background:#003b7a; border:none;">
                    🔍
                </button>
            </div>

            <!-- BOTÓN REGISTRAR -->
            <div class="col-md-2 d-grid">
                <a href="{{ route('clientes.create') }}" class="btn btn-orange">
                    + Registrar
                </a>
            </div>
        </form>
    </div>

    <!-- FILTRO POR ÚLTIMO DÍGITO -->
    <div class="mb-3">
        <a href="{{ route('clientes.index') }}"
           class="btn btn-light btn-sm btn-num {{ $ultimo === null ? 'btn-filter-active' : '' }}">
            Todos
        </a>

        @for($i = 0; $i <= 9; $i++)
            <a href="{{ route('clientes.index', ['ultimo' => $i]) }}"
               class="btn btn-outline-primary btn-sm btn-num {{ $ultimo == $i ? 'btn-filter-active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>

    <!-- TABLA -->
    <div class="table-modern">
        <table class="table mb-0 table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre / Razón Social</th>
                <th>RUC</th>
                <th>DNI</th>
                <th>Grupo</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
            </thead>

            <tbody>

            @foreach($clientes as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td class="fw-semibold">{{ $c->nombre }}</td>
                    <td>{{ $c->ruc }}</td>
                    <td>{{ $c->dni ?? '-' }}</td>
                    <td>{{ $c->grupo ?? '-' }}</td>

                    <td>
                        @switch($c->estado)
                            @case('urgente')
                                <span class="badge-modern badge-urgente">urgente</span>
                                @break
                            @case('proxima_fecha')
                                <span class="badge-modern badge-proxima">próxima fecha</span>
                                @break
                            @case('concluido')
                                <span class="badge-modern badge-concluido">concluido</span>
                                @break
                            @default
                                <span class="badge-modern badge-inactivo">inactivo</span>
                        @endswitch
                    </td>

                    <td class="text-end">
                        <a href="{{ route('clientes.edit', $c) }}" class="btn-icon btn-edit me-1">✏</a>

                        <form action="{{ route('clientes.destroy', $c) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn-icon btn-delete"
                                    onclick="return confirm('¿Eliminar cliente?')">
                                🗑
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <!-- PAGINACIÓN -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $clientes->links() }}
    </div>


</div>

@endsection
