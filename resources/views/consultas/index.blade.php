@extends('layouts.app')

@section('title', 'Consultas SUNAT')

@section('content')

<style>
    .title-page {
        color: #003b7a;
        font-weight: 800;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .card-box {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        padding: 20px;
        transition: 0.25s;
    }

    .card-box:hover {
        transform: translateY(-4px);
    }

    .btn-custom {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: 700;
        color: white;
    }

    .btn-blue { background: #003b7a; }
    .btn-blue:hover { background: #024279; }

    .btn-orange { background: #ff7c00; }
    .btn-orange:hover { background: #e56f00; }

    .btn-purple { background: #6f42c1; }
    .btn-purple:hover { background: #59359f; }

    .btn-indigo { background: #4b4dfb; }
    .btn-indigo:hover { background: #3638d8; }

</style>

<div class="container">

    <h1 class="title-page">🔍 Consultas SUNAT</h1>

    <div class="row g-4">

        <!-- Consulta RUC -->
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-2">Consulta de RUC</h5>

                <form onsubmit="return consultarRuc()">
                    <input id="rucInput" type="text" maxlength="11"
                        class="form-control mb-3"
                        placeholder="Ingrese número de RUC">
                    <button type="submit" class="btn-custom btn-blue">
                        Consultar RUC
                    </button>
                </form>
            </div>
        </div>

        <!-- Mis Declaraciones y Pagos -->
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-2">Mis Declaraciones y Pagos</h5>
                <p class="text-muted small">
                    Accede a declaraciones juradas y pagos registrados en SUNAT.
                </p>
                <button onclick="openDeclaraciones()"
                    class="btn-custom btn-orange">
                    Abrir Plataforma
                </button>
            </div>
        </div>

        <!-- Mis Trámites -->
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-2">Mis Trámites y Consultas</h5>
                <p class="text-muted small">
                    Verifica el estado de trámites electrónicos.
                </p>
                <button onclick="openTramites()"
                    class="btn-custom btn-indigo">
                    Ir al Portal
                </button>
            </div>
        </div>

        <!-- SUNAT Fiel -->
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-2">SUNAT Operaciones en Línea</h5>
                <p class="text-muted small">
                    Inicia sesión con tu Clave SOL.
                </p>
                <button onclick="openSunatFiel()"
                    class="btn-custom btn-purple">
                    Acceder a SOL
                </button>
            </div>
        </div>

    </div>
</div>

{{-- JS funciones --}}
<script>
function consultarRuc() {
    let ruc = document.getElementById("rucInput").value.trim();
    if (!ruc) {
        alert("⚠️ Ingrese un RUC antes de consultar.");
        return false;
    }

    window.open(
        `https://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias?accion=consPorRuc&nroRuc=${ruc}`,
        "_blank"
    );

    return false;
}

function openSunatFiel() {
    window.open(
      "https://api-seguridad.sunat.gob.pe/v1/clientessol/b6474e23-8a3b-4153-b301-dafcc9646250/oauth2/login?originalUrl=https://casillaelectronica.sunafil.gob.pe/si.inbox/Login/Empresa&state=s",
      "_blank"
    );
}

function openDeclaraciones() {
    window.open(
      "https://e-menu.sunat.gob.pe/cl-ti-itmenu2/MenuInternetPlataforma.htm?pestana=*&agrupacion=*&exe=55.1.1.1.1#",
      "_blank"
    );
}

function openTramites() {
    window.open(
      "https://e-menu.sunat.gob.pe/cl-ti-itmenu/MenuInternet.htm?pestana=*&agrupacion=*",
      "_blank"
    );
}
</script>

@endsection
