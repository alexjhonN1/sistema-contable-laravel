@extends('layouts.app')

@section('title', 'Constancias - Próxima Actualización')

@section('content')

<style>
    .coming-container {
        text-align: center;
        padding: 80px 20px;
        color: #003b7a;
    }
    .coming-title {
        font-size: 42px;
        font-weight: 800;
        color: #003b7a;
    }
    .coming-subtitle {
        font-size: 20px;
        margin-top: 15px;
        color: #4b4b4b;
    }
    .coming-box {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0px 6px 20px rgba(0,0,0,0.12);
        padding: 50px;
        max-width: 700px;
        margin: auto;
    }

    .emoji-big {
        font-size: 80px;
        margin-bottom: 15px;
    }
</style>

<div class="coming-container">
    <div class="coming-box">

        <div class="emoji-big">⏳</div>

        <h1 class="coming-title">Módulo en Desarrollo</h1>
        <p class="coming-subtitle">
            El módulo <strong>Constancias SUNAT</strong> estará disponible pronto.<br>
            Estamos trabajando para ofrecerte una experiencia rápida y confiable.
        </p>

        <p class="mt-4" style="color:#ff7c00; font-weight:bold;">
            Próxima Actualización 🔧
        </p>

    </div>
</div>

@endsection
