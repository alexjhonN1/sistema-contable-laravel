<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        // Capturar filtros
        $buscar = $request->input('buscar');   // nombre o apellidos
        $dni = $request->input('dni');         // dni
        $tipo = $request->input('tipo');       // tipo de empleado

        // Query con filtros dinámicos
        $empleados = Empleado::with('cliente')
            ->when($buscar, function ($query) use ($buscar) {
                $query->whereRaw("CONCAT(apellido_paterno, ' ', apellido_materno, ' ', nombres) LIKE ?", ["%{$buscar}%"]);
            })
            ->when($dni, function ($query) use ($dni) {
                $query->where('numero_documento', 'LIKE', "%{$dni}%");
            })
            ->when($tipo, function ($query) use ($tipo) {
                $query->where('tipo', $tipo);
            })
            ->orderBy('apellido_paterno')
            ->paginate(10)
            ->withQueryString(); // Mantiene los filtros al paginar

        return view('empleados.index', compact('empleados', 'buscar', 'dni', 'tipo'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('empleados.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'tipo' => 'required',
            'numero_documento' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'fecha_ingreso' => 'required',
            'sueldo' => 'required|numeric',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('empleados.edit', compact('empleado', 'clientes'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'cliente_id' => 'required',
            'tipo' => 'required',
            'numero_documento' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'fecha_ingreso' => 'required',
            'sueldo' => 'required|numeric',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return back()->with('success', 'Empleado eliminado.');
    }
}
