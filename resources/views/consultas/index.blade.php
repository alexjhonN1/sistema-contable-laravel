@extends('layouts.app')

@section('content')
<h3>🔍 Consultas SUNAT</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row g-3">

            <!-- Consulta RUC -->
            <div class="col-md-4">
                <a href="https://www.sunat.gob.pe/ol-ti-itmrconsruc-frame/ConsRucInternet.jsp"
                   target="_blank" class="btn btn-primary w-100">
                    🔵 Consulta RUC
                </a>
            </div>

            <!-- Libros PLE -->
            <div class="col-md-4">
                <a href="https://www.sunat.gob.pe/ol-ti-itcple/FrameCriterioCons.jsp"
                   target="_blank" class="btn btn-success w-100">
                    📘 Consulta Libros Electrónicos PLE
                </a>
            </div>

            <!-- Constancias SUNAT -->
            <div class="col-md-4">
                <a href="https://www.sunat.gob.pe/ol-tin-itconsruc-jabi/?accion=ini"
                   target="_blank" class="btn btn-warning w-100">
                    📄 Consulta Constancias
                </a>
            </div>

            <!-- Comprobantes electrónicos -->
            <div class="col-md-4 mt-3">
                <a href="https://e-consulta.sunat.gob.pe/ol-it-wsconsretencion/consulta"
                   target="_blank" class="btn btn-info w-100">
                    🧾 Validación de Comprobantes
                </a>
            </div>

            <!-- Deudas / Omisos -->
            <div class="col-md-4 mt-3">
                <a href="https://www.sunat.gob.pe/ol-tm-itcconsdeu/"
                   target="_blank" class="btn btn-danger w-100">
                    ⚠ Consulta de Deudas / Omisos
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
