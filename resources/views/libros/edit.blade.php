@extends('layouts.app')

@section('title','Editar Libro SUNAT')

@section('content')
<div class="container">

    <h3 class="fw-bold mb-4" style="color:#004aad;">✏ Editar Libro SUNAT</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Cliente -->
                    <div class="col-md-6">
                        <label class="fw-bold" style="color:#003b7a;">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            @foreach ($clientes as $cli)
                                <option value="{{ $cli->id }}" 
                                    {{ $libro->cliente_id == $cli->id ? 'selected' : '' }}>
                                    {{ $cli->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo Libro -->
                    <div class="col-md-6">
                        <label class="fw-bold" style="color:#003b7a;">Tipo de Libro</label>
                        <select name="tipo_libro" class="form-select" required>
                            <option value="compras"     {{ $libro->tipo_libro=='compras'?'selected':'' }}>Compras</option>
                            <option value="ventas"      {{ $libro->tipo_libro=='ventas'?'selected':'' }}>Ventas</option>
                            <option value="diario"      {{ $libro->tipo_libro=='diario'?'selected':'' }}>Diario</option>
                            <option value="mayor"       {{ $libro->tipo_libro=='mayor'?'selected':'' }}>Mayor</option>
                            <option value="inventarios" {{ $libro->tipo_libro=='inventarios'?'selected':'' }}>Inventarios</option>
                            <option value="balance"     {{ $libro->tipo_libro=='balance'?'selected':'' }}>Balance</option>
                            <option value="otro"        {{ $libro->tipo_libro=='otro'?'selected':'' }}>Otro</option>
                        </select>
                    </div>

                    <!-- Periodo -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Periodo (AAAAMM)</label>
                        <input type="text" name="periodo" 
                               class="form-control" 
                               value="{{ $libro->periodo }}" required>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="pendiente" {{ $libro->estado=='pendiente'?'selected':'' }}>Pendiente</option>
                            <option value="enviado"   {{ $libro->estado=='enviado'?'selected':'' }}>Enviado</option>
                            <option value="observado" {{ $libro->estado=='observado'?'selected':'' }}>Observado</option>
                        </select>
                    </div>

                    <!-- Archivo -->
                    <div class="col-md-4">
                        <label class="fw-bold" style="color:#003b7a;">Archivo TXT (si deseas actualizar)</label>
                        <input type="file" name="archivo" class="form-control">

                        @if($libro->archivo)
                            <small class="text-primary">
                                Archivo actual: 
                                <a href="/libros/{{ $libro->archivo }}" target="_blank">Ver archivo</a>
                            </small>
                        @endif
                    </div>

                    <!-- Observaciones -->
                    <div class="col-md-12">
                        <label class="fw-bold" style="color:#003b7a;">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3">
                            {{ $libro->observaciones }}
                        </textarea>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 text-end mt-3">
                        <a href="{{ route('libros.index') }}" class="btn btn-secondary">
                            ← Volver
                        </a>

                        <button class="btn fw-bold" style="background:#ffbe00; color:#000;">
                            💾 Actualizar Registro
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
