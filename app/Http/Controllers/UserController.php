<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Escuela;
use App\Models\Inscrito;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user && $user->tipo_id === 1) {
                return $next($request);
            }

            return redirect()->route("handler.index");
        });
    }

    public function index()
    {
        $roles = $this->get_active_roles();

        // seleccionaa el primer rol (default)
        $rol = $roles[0];

        return $this->handler($rol);
    }

    public function handler(Rol $rol)
    {
        $roles = $this->get_active_roles();

        // verificar si el usuario tiene acceso
        $res = $roles->toQuery()->where("id", "=", $rol["id"])->get();

        if ($res->isEmpty()) {
            // no tiene permiso
            return redirect()->route("handler.index");
        }

        switch ($rol["id"]) {
            case '1':
                return $this->inscribir($roles, $rol);
                break;
            default:
                // si el id rol es desconocido
                break;
        }
    }

    public function inscribir($roles, $rol)
    {
        $escuela = auth()->user()->escuela;

        $deportes = Deporte::orderBy("name", "ASC")->get();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["num_inscritos"] = $this->get_inscritos_escuela_deporte($escuela, $deporte)->count();
        }

        return view("delegado.inscribir", ["roles" => $roles, "current_rol" => $rol, "escuela" => $escuela, "group_deportes" => $group_deportes]);
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

    public function get_inscritos_escuela_deporte(Escuela $escuela, Deporte $deporte)
    {
        $inscrito = 1;

        $inscritos = Inscrito::where("escuela_id", "=", $escuela->id)
            ->where("deporte_id", "=", $deporte->id)
            ->where("estado_id", "=", $inscrito)
            ->get();

        return $inscritos;
    }

    public function inscritos(Rol $rol, Escuela $escuela, Deporte $deporte)
    {
        $reporte_controller = new ReporteController;

        return $reporte_controller->inscritos_by_escuela_deporte($rol, $escuela, $deporte);
    }
}
