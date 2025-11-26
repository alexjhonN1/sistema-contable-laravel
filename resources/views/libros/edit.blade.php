@extends('layouts.dashboard')

@section('content')

<h3>✏ Editar Libro SUNAT</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Cliente</label>
                    <select name="cliente_id" class="form-control" required>
                        @foreach ($clientes as $cli)
                            <option value="{{ $cli->id }}" {{ $libro->cliente_id == $cli->id ? 'selected' : '' }}>
                                {{ $cli->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tipo de Libro</label>
                    <select name="tipo_libro" class="form-control" required>
                        <option value="compras"     {{ $libro->tipo_libro=='compras'?'selected':'' }}>Compras</option>
                        <option value="ventas"      {{ $libro->tipo_libro=='ventas'?'selected':'' }}>Ventas</option>
                        <option value="diario"      {{ $libro->tipo_libro=='diario'?'selected':'' }}>Diario</option>
                        <option value="mayor"       {{ $libro->tipo_libro=='mayor'?'selected':'' }}>Mayor</option>
                        <option value="inventarios" {{ $libro->tipo_libro=='inventarios'?'selected':'' }}>Inventarios</option>
                        <option value="balance"     {{ $libro->tipo_libro=='balance'?'selected':'' }}>Balance</option>
                        <option value="otro"        {{ $libro->tipo_libro=='otro'?'selected':'' }}>Otro</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Periodo</label>
                    <input type="text" name="periodo" class="form-control" value="{{ $libro->periodo }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="pendiente" {{ $libro->estado=='pendiente'?'selected':'' }}>Pendiente</option>
                        <option value="enviado"   {{ $libro->estado=='enviado'?'selected':'' }}>Enviado</option>
                        <option value="observado" {{ $libro->estado=='observado'?'selected':'' }}>Observado</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Archivo TXT (si deseas actualizar)</label>
                    <input type="file" name="archivo" class="form-control">

                    @if($libro->archivo)
                        <small class="text-primary">
                            Archivo actual: <a href="/libros/{{ $libro->archivo }}" target="_blank">ver archivo</a>
                        </small>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ $libro->observaciones }}</textarea>
                </div>

                <div class="col-md-12 text-end">
                    <a href="{{ route('libros.index') }}" class="btn btn-secondary">🔙 Volver</a>
                    <button class="btn btn-primary">💾 Actualizar</button>
                </div>

            </div>

        </form>

    </div>
</div>

@endsection
