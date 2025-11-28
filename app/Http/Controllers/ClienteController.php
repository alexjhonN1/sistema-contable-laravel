<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $ultimo = $request->query('ultimo');     // último dígito del RUC
        $busqueda = $request->query('search');   // búsqueda general
        $ruc = $request->query('search_ruc');    // búsqueda exacta RUC
        $dni = $request->query('search_dni');    // búsqueda DNI

        $clientes = Cliente::query();

        // FILTRO POR ÚLTIMO DÍGITO DEL RUC
        if ($ultimo !== null) {
            $clientes->where('ruc', 'like', "%$ultimo");
        }

        // BUSCADOR GENERAL (nombre o ruc)
        if ($busqueda) {
            $clientes->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'like', "%$busqueda%")
                  ->orWhere('ruc', 'like', "%$busqueda%");
            });
        }

        // BÚSQUEDA ESPECÍFICA POR RUC
        if ($ruc) {
            $clientes->where('ruc', 'like', "%$ruc%");
        }

        // BÚSQUEDA ESPECÍFICA POR DNI
        if ($dni) {
            $clientes->where('dni', 'like', "%$dni%");
        }

        // PAGINACIÓN (10 clientes por página)
        $clientes = $clientes->orderBy('id', 'ASC')->paginate(10);

        return view('clientes.index', compact('clientes','ultimo','busqueda'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'required|digits:11|unique:clientes,ruc',
            'dni' => 'nullable|digits:8',
            'clave_sol' => 'nullable|string',
            'password_sol' => 'nullable|string',
            'grupo' => 'nullable|string|max:100',
            'estado' => 'required',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                         ->with('success','Cliente registrado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'required|digits:11|unique:clientes,ruc,'.$cliente->id,
            'dni' => 'nullable|digits:8',
            'grupo' => 'nullable|string',
            'estado' => 'required',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
                         ->with('success','Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
                         ->with('success','Cliente eliminado.');
    }
}
