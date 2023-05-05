<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Inscrito;
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

    public function get_inscritos_deporte(Deporte $deporte)
    {
        $user_id = auth()->user()->id;
        $inscrito = 1;

        $inscritos = Inscrito::join("users", "inscritos.user_id", "=", "users.id")
            ->join("deportes", "inscritos.deporte_id", "=", "deportes.id")
            ->join("estados", "inscritos.estado_id", "=", "estados.id")
            ->where("deportes.id", "=", $deporte->id)
            ->where("users.id", "=", $user_id)
            ->where("estados.id", "=", $inscrito)
            ->get("inscritos.*");

        return $inscritos;
    }

    public function inscribir($roles, $rol)
    {
        $deportes = Deporte::orderBy("name", "ASC")->get();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["num_inscritos"] = $this->get_inscritos_deporte($deporte)->count();
        }

        return view("user.inscribir", ["roles" => $roles, "current_rol" => $rol, "group_deportes" => $group_deportes]);
    }
}
