<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('cliente')
            ->orderBy('apellido_paterno')
            ->paginate(15);

        return view('empleados.index', compact('empleados'));
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
