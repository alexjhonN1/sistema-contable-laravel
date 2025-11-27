<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Reporte del Día - {{ $hoy }}</h2>

<table>
    <thead>
        <tr>
            <th>Hora</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Periodo</th>
            <th>Estado</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
    @foreach($detalle as $item)
        <tr>
            <td>{{ $item->created_at->format('H:i') }}</td>
            <td>{{ $item->cliente->nombre }}</td>
            <td>{{ ucfirst($item->tipo_libro) }}</td>
            <td>{{ $item->periodo }}</td>
            <td>{{ ucfirst($item->estado) }}</td>
            <td>{{ $item->usuario->name ?? 'Sistema' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
