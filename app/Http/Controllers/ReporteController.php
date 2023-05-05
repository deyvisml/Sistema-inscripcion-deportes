<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Inscrito;
use Illuminate\Http\Request;

class ReporteController extends Controller
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

    public function index(Deporte $deporte)
    {
        $rol = Rol::find(1);
        $roles = $this->get_active_roles();

        $inscritos = $this->get_inscritos_deporte($deporte);

        return view("reporte.index", ["roles" => $roles, "current_rol" => $rol, "deporte" => $deporte, "inscritos" => $inscritos]);
    }
}
