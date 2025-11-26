<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // LISTAR USUARIOS
    public function index()
    {
        $usuarios = User::with('role')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    // GUARDAR NUEVO USUARIO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80',
            'email' => 'required|email|max:120|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    // FORMULARIO EDITAR
    public function edit(User $usuario)
    {
        $roles = Role::all();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    // ACTUALIZAR USUARIO
    public function update(Request $request, User $usuario)
    {
        // Protección: evitar modificar SuperAdmin
        if ($usuario->role->nombre === 'superadmin') {
            return back()->with('error', 'No puedes modificar al SuperAdmin.');
        }

        $request->validate([
            'name' => 'required|string|max:80',
            'email' => 'required|email|max:120|unique:users,email,' . $usuario->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role_id = $request->role_id;

        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    // ELIMINAR
    public function destroy(User $usuario)
    {
        // Proteger SuperAdmin
        if ($usuario->role->nombre === 'superadmin') {
            return back()->with('error', 'No puedes eliminar al SuperAdmin.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
