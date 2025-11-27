@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

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
        width: 100%;
        border-radius: 8px;
        padding: 10px;
        font-weight: 600;
        border: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="auth-card">

                <h3 class="fw-bold text-primary">Restablecer Contraseña</h3>
                <p class="text-muted">Te enviaremos un enlace a tu correo.</p>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-bold">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <button class="btn-orange">Enviar Enlace</button>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
