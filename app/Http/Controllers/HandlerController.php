<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // redirige a la aplicación

        $user = auth()->user();

        $roles = $user->roles;

        if (count($roles) == 0) {
            abort(403, 'No tienes permiso para realizar esta acción.');
            return;
        }

        $first_role = $roles[0];
        $permissions = $first_role->permissions;

        if (count($permissions) == 0) {
            abort(403, 'No tienes permiso para realizar esta acción.');
            return;
        }

        $first_permission = $permissions[0];
        $permission_route_name = $first_permission->route_name;

        return redirect()->route($permission_route_name);
    }
}
