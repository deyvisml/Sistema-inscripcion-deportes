<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission_id): Response
    {
        $permission = Permission::find($permission_id);

        // Verificar si el usuario tiene el permiso especificado
        if ($permission && $request->user() && $request->user()->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para realizar esta acción.');
    }
}
