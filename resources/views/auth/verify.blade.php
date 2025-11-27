@extends('layouts.app')

@section('title', 'Verificar Correo')

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
        padding: 10px 20px;
        border: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="auth-card">

                <h3 class="fw-bold text-primary">Verifica tu Correo</h3>

                @if (session('resent'))
                    <div class="alert alert-success">
                        Se ha enviado un nuevo enlace de verificación.
                    </div>
                @endif

                <p class="text-muted">Antes de continuar, revisa tu bandeja de entrada.</p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="btn-orange">Reenviar Email</button>
                </form>

            </div>

        </div>
    </div>
</div>

@endsection
