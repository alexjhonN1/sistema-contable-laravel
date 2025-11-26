<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  string  ...$roles   // ahora acepta múltiples roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar autenticación
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRol = Auth::user()->role->nombre;

        // Si el rol del usuario NO está en la lista de roles permitidos
        if (!in_array($userRol, $roles)) {
            abort(403, "No tienes permiso para acceder a esta sección.");
        }

        return $next($request);
    }
}
