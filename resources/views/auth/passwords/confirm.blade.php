@extends('layouts.app')

@section('title', 'Confirmar Contraseña')

@section('content')

<style>
    .card-modern {
        border-radius: 14px;
        border: none;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.10);
        padding: 25px;
    }

    .card-modern h4 {
        color: #003b7a;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .card-modern p {
        color: #555;
        font-size: 15px;
    }

    .btn-orange {
        background: #ff7c00;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px 18px;
        border: none;
    }

    .btn-orange:hover {
        background: #e56f00;
        color: white;
    }

    .text-link {
        font-weight: 600;
        color: #003b7a;
    }

    .text-link:hover {
        text-decoration: underline;
        color: #002d5d;
    }

    label {
        font-weight: 600;
        color: #003b7a;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-modern">
                <h4>Confirmar Contraseña</h4>

                <p>Por favor, confirma tu contraseña antes de continuar.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Botón -->
                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <button type="submit" class="btn btn-orange">
                            Confirmar Contraseña
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
