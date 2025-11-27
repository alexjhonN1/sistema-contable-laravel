@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')

<style>
    .auth-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.10);
        padding: 30px;
        background: white;
    }
    .auth-title {
        color: #003b7a;
        font-weight: 800;
        font-size: 28px;
        margin-bottom: 10px;
    }
    .auth-desc {
        color: #666;
        margin-bottom: 25px;
    }
    .btn-orange {
        background: #ff7c00;
        color: white;
        border-radius: 8px;
        font-weight: bold;
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
    .auth-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="auth-card">

                <h2 class="auth-title">Iniciar Sesión</h2>
                <p class="auth-desc">Accede a tu cuenta para continuar.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="fw-bold text-primary">Correo Electrónico</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required autofocus>

                        @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="fw-bold text-primary">Contraseña</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label">Recordarme</label>
                    </div>

                    <button class="btn-orange">Ingresar</button>

                    <div class="mt-3 text-center">
                        @if (Route::has('password.request'))
                            <a class="auth-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <div class="mt-2 text-center">
                        <a class="auth-link" href="{{ route('register') }}">
                            Crear una cuenta nueva
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
