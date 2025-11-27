@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')

<style>
    .auth-card {
        border-radius: 16px;
        border: none;
        background: white;
        padding: 30px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.10);
    }
    .auth-title {
        color: #003b7a;
        font-weight: 800;
        font-size: 28px;
        margin-bottom: 10px;
    }
    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        width: 100%;
        padding: 10px;
        border: none;
    }
    .btn-orange:hover {
        background: #e56f00;
    }
    .auth-link {
        color: #003b7a;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="auth-card">

                <h2 class="auth-title">Crear Cuenta</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-bold">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn-orange">Registrarse</button>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="auth-link">¿Ya tienes cuenta? Inicia sesión</a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
