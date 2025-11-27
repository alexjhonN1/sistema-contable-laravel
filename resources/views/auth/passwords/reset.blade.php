@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')

<style>
    .auth-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    }
    .btn-orange {
        background: #ff7c00;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        padding: 10px;
        border: none;
    }
    .btn-orange:hover { background: #e56f00; }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="auth-card">

                <h3 class="text-primary fw-bold">Restablecer Contraseña</h3>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label class="fw-bold">Correo Electrónico</label>
                        <input type="email" name="email"
                               class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn-orange">Cambiar Contraseña</button>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
