@extends('layouts.app')

@section('title','Registrar Libro SUNAT')

@section('content')
<div class="container">

    <h3 class="fw-bold mb-4" style="color:#004aad;">➕ Registrar Libro SUNAT</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- Cliente -->
                    <div class="col-md-6">
                        <label class="fw-bold" style="color:#003b7a;">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            <option value="">Seleccione</option>
                            @foreach ($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo de Libro -->
                    <div class="col-md-6">
                        <label class="fw-bold" style="color:#003b7a;">Tipo de Libro</label>
                        <select name="tipo_libro" class="form-select" required>
                            <option value="compras">Registro de Compras</option>
                            <option value="ventas">Registro de Ventas</option>
                            <option value="diario">Libro Diario</option>
                            <option value="mayor">Libro Mayor</option>
                            <option value="inventarios">Inventarios</option>
                            <option value="balance">Balance</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>

                    <!-- Periodo -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Periodo (AAAAMM)</label>
                        <input type="text" name="periodo" class="form-control" placeholder="Ej: 202412" required>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="pendiente">Pendiente</option>
                            <option value="enviado">Enviado</option>
                            <option value="observado">Observado</option>
                        </select>
                    </div>

                    <!-- Archivo -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Archivo TXT (opcional)</label>
                        <input type="file" name="archivo" class="form-control">
                    </div>

                    <!-- Observaciones -->
                    <div class="col-md-12">
                        <label class="fw-bold" style="color:#003b7a;">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3" placeholder="Escriba una observación si es necesario..."></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 text-end mt-3">
                        <a href="{{ route('libros.index') }}" class="btn btn-secondary">
                            ← Volver
                        </a>

                        <button class="btn fw-bold" 
                                style="background:#ffbe00; color:#000;">
                            💾 Guardar Registro
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
