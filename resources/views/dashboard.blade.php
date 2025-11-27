@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- ESTILOS MODERNOS -->
<style>
    /* TÍTULO PRINCIPAL */
    .title-dashboard {
        color: #003b7a;
        font-weight: 800;
        font-size: 30px;
        letter-spacing: -0.5px;
        margin-bottom: 15px;
    }

    /* SUBTÍTULO / ALERTA */
    .subtitle-box {
        background: #fff7e6;
        border-left: 6px solid #ff7c00;
        padding: 14px 16px;
        border-radius: 8px;
        color: #6a5e00;
        font-size: 15px;
        margin-bottom: 30px;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.06);
    }

    /* TARJETAS MODERNAS */
    .module-card {
        background: white;
        border-radius: 14px;
        padding: 26px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.07);
        transition: all .25s ease;
        text-decoration: none;
        display: block;
    }

    .module-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0,0,0,0.10);
    }

    /* ICONOS */
    .module-icon {
        font-size: 40px;
        color: #003b7a;
        margin-bottom: 12px;
    }

    /* TÍTULO DE LA TARJETA */
    .module-title {
        font-size: 19px;
        font-weight: 700;
        color: #003b7a;
    }

    /* DESCRIPCIÓN */
    .module-desc {
        font-size: 14px;
        color: #505050;
        margin-bottom: 18px;
    }

    /* BOTÓN */
    .btn-orange {
        background-color: #ff7c00;
        color: white;
        border-radius: 8px;
        border: none;
        padding: 10px;
        font-weight: 600;
        width: 100%;
        transition: .2s;
    }

    .btn-orange:hover {
        background-color: #e56f00;
        color: white;
    }
</style>

<!-- TÍTULO -->
<h2 class="title-dashboard">
    Bienvenido, {{ Auth::user()->role->nombre ?? 'Usuario' }}
</h2>

<!-- SUBTÍTULO -->
<div class="subtitle-box">
    Este es tu panel principal. Desde aquí podrás gestionar todo el Sistema Híbrido Contable.
</div>

<!-- TARJETAS MINIMALISTAS -->
<div class="row g-4">

    <!-- Usuarios -->
    <div class="col-md-4">
        <a href="/usuarios" class="module-card">
            <div class="module-icon">👥</div>
            <div class="module-title">Usuarios</div>
            <div class="module-desc">Administrar cuentas y permisos.</div>
            <button class="btn-orange">Entrar</button>
        </a>
    </div>

    <!-- Roles -->
    <div class="col-md-4">
        <a href="/roles" class="module-card">
            <div class="module-icon">🔐</div>
            <div class="module-title">Roles</div>
            <div class="module-desc">Gestionar roles y autorizaciones.</div>
            <button class="btn-orange">Entrar</button>
        </a>
    </div>

    <!-- Clientes -->
    <div class="col-md-4">
        <a href="/clientes" class="module-card">
            <div class="module-icon">🏢</div>
            <div class="module-title">Clientes</div>
            <div class="module-desc">Registrar y gestionar clientes y proveedores.</div>
            <button class="btn-orange">Entrar</button>
        </a>
    </div>

</div>

@endsection
