<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_active_roles()
    {
        $tipo = auth()->user()->tipo;

        $roles = Acceso::join("tipos", "accesos.tipo_id", "=", "tipos.id")
            ->join("roles", "accesos.rol_id", "=", "roles.id")
            ->join("estados", "accesos.estado_id", "=", "estados.id")
            ->where("tipos.id", "=", $tipo["id"])
            ->where("estados.name", "=", "activo")
            ->pluck("roles.id")
            ->all();

        $roles = Rol::whereIn("id", $roles)->get();

        return $roles;
    }

    public function index()
    {
        $roles = $this->get_active_roles();

        // seleccionaa el primer rol (default)
        $rol = $roles[0];

        return redirect()->route("user.handler", ["rol" => $rol]);
    }

    public function handler(Rol $rol)
    {
        $roles = $this->get_active_roles();

        // verificar si el usuario tiene acceso
        $res = $roles->toQuery()->where("id", "=", $rol["id"])->get();

        if ($res->isEmpty()) {
            // no tiene permiso
            return redirect()->route("user.index");
        }

        switch ($rol["id"]) {
            case '1':
                return $this->inscribir($roles, $rol);
                break;
            case '2':
                dd("reporte judadores");
                break;

            default:
                // si el id rol es desconocido
                break;
        }
    }

    public function inscribir($roles, $rol)
    {
        //dd("inscribir");


        return view("user.inscribir", ["roles" => $roles, "current_rol" => $rol]);
    }
}
