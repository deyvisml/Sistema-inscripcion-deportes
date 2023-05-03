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

    public function index()
    {
        // tipo de usuario
        $tipo = auth()->user()->tipo;

        // roles de usuario
        $roles = Acceso::join("tipos", "accesos.tipo_id", "=", "tipos.id")
            ->join("roles", "accesos.rol_id", "=", "roles.id")
            ->where("accesos.tipo_id", "=", $tipo["id"])->get("roles.*");

        // seleccionaa el primer rol (default)
        $rol = $roles[0];

        return redirect()->route($rol["url"]);
    }

    public function has_permisson(Rol $rol)
    {
        // tipo de usuario
        $tipo = auth()->user()->tipo;

        // verificar si tiene permiso
        $res = Acceso::join("tipos", "accesos.tipo_id", "=", "tipos.id")
            ->join("roles", "accesos.rol_id", "=", "roles.id")
            ->where("accesos.tipo_id", "=", $tipo["id"])
            ->where("roles.id", "=", $rol["id"])
            ->get("roles.*");

        if ($res->isEmpty()) {
            return false;
        }

        return true;
    }

    public function inscribir()
    {
        $rol = Rol::find(1);

        if (!$this->has_permisson($rol)) {
            return redirect()->route("user.index");
        }

        // get roles desde el modelo del usuario

        dd("with permisson");
    }
}
