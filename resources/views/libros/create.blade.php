@extends('layouts.app')

@section('content')

<h3>➕ Registrar Libro SUNAT</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Cliente</label>
                    <select name="cliente_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach ($clientes as $cli)
                            <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tipo de Libro</label>
                    <select name="tipo_libro" class="form-control" required>
                        <option value="compras">Registro de Compras</option>
                        <option value="ventas">Registro de Ventas</option>
                        <option value="diario">Libro Diario</option>
                        <option value="mayor">Libro Mayor</option>
                        <option value="inventarios">Inventarios</option>
                        <option value="balance">Balance</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Periodo (AAAAMM)</label>
                    <input type="text" name="periodo" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="pendiente">Pendiente</option>
                        <option value="enviado">Enviado</option>
                        <option value="observado">Observado</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Archivo TXT (opcional)</label>
                    <input type="file" name="archivo" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control"></textarea>
                </div>

                <div class="col-md-12 text-end">
                    <a href="{{ route('libros.index') }}" class="btn btn-secondary">🔙 Volver</a>
                    <button class="btn btn-primary">💾 Guardar</button>
                </div>

            </div>

        </form>

    </div>
</div>

@endsection
