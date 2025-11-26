<?php

namespace App\Http\Controllers;

use App\Models\LibroSunat;
use App\Models\Cliente;
use Illuminate\Http\Request;

class LibroSunatController extends Controller
{
    public function index(Request $request)
    {
        $periodo = $request->periodo;
        $estado = $request->estado;

        $libros = LibroSunat::with('cliente');

        if ($periodo) {
            $libros->where('periodo', $periodo);
        }

        if ($estado) {
            $libros->where('estado', $estado);
        }

        $libros = $libros->orderBy('id', 'DESC')->get();

        return view('libros.index', compact('libros', 'periodo', 'estado'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('libros.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'tipo_libro' => 'required',
            'periodo'    => 'required|digits:6',
            'estado'     => 'required',
            'archivo'    => 'nullable|mimes:txt',
        ]);

        $nombreArchivo = null;

        if ($request->archivo) {
            $nombreArchivo = time().'_'.$request->archivo->getClientOriginalName();
            $request->archivo->move(public_path('libros'), $nombreArchivo);
        }

        LibroSunat::create([
            'cliente_id' => $request->cliente_id,
            'tipo_libro' => $request->tipo_libro,
            'periodo'    => $request->periodo,
            'estado'     => $request->estado,
            'archivo'    => $nombreArchivo,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('libros.index')->with('success', 'Libro registrado correctamente');
    }

    public function edit(LibroSunat $libro)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('libros.edit', compact('libro', 'clientes'));
    }

    public function update(Request $request, LibroSunat $libro)
    {
        $request->validate([
            'cliente_id' => 'required',
            'tipo_libro' => 'required',
            'periodo'    => 'required|digits:6',
            'estado'     => 'required',
            'archivo'    => 'nullable|mimes:txt',
        ]);

        if ($request->archivo) {
            $nombreArchivo = time().'_'.$request->archivo->getClientOriginalName();
            $request->archivo->move(public_path('libros'), $nombreArchivo);
            $libro->archivo = $nombreArchivo;
        }

        $libro->update($request->except('archivo'));

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente');
    }

    public function destroy(LibroSunat $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado');
    }
}
