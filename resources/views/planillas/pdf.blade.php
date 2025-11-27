<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Planilla {{ $planilla->mes }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align:left; }
        th { background: #eaeaea; }
    </style>
</head>

<body>

<h2>PLANILLA MENSUAL - {{ $planilla->mes }}</h2>

<p><strong>Empresa:</strong> {{ $planilla->cliente->nombre }}  
<br><strong>RUC:</strong> {{ $planilla->cliente->ruc }}</p>

<h3>Trabajadores</h3>
<table>
    <thead>
        <tr>
            <th>DNI</th>
            <th>Empleado</th>
            <th>Días</th>
            <th>Ingresos</th>
            <th>Descuentos</th>
            <th>Aporte Trab.</th>
            <th>Neto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalles->where('tipo', 'trabajador') as $d)
        <tr>
            <td>{{ $d->empleado->numero_documento }}</td>
            <td>{{ $d->empleado->nombre_completo }}</td>
            <td>{{ $d->dias }}</td>
            <td>{{ number_format($d->ingresos,2) }}</td>
            <td>{{ number_format($d->descuentos,2) }}</td>
            <td>{{ number_format($d->aporte_trabajador,2) }}</td>
            <td>{{ number_format($d->neto_pagar,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Pensionistas</h3>
<table>
    <thead>
        <tr>
            <th>DNI</th>
            <th>Empleado</th>
            <th>Ingresos</th>
            <th>Aporte</th>
            <th>Neto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalles->where('tipo', 'pensionado') as $d)
        <tr>
            <td>{{ $d->empleado->numero_documento }}</td>
            <td>{{ $d->empleado->nombre_completo }}</td>
            <td>{{ number_format($d->ingresos,2) }}</td>
            <td>{{ number_format($d->aporte_trabajador,2) }}</td>
            <td>{{ number_format($d->neto_pagar,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Independientes</h3>
<table>
    <thead>
        <tr>
            <th>DNI</th>
            <th>Empleado</th>
            <th>Ingresos</th>
            <th>Neto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalles->where('tipo', 'independiente') as $d)
        <tr>
            <td>{{ $d->empleado->numero_documento }}</td>
            <td>{{ $d->empleado->nombre_completo }}</td>
            <td>{{ number_format($d->ingresos,2) }}</td>
            <td>{{ number_format($d->neto_pagar,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
