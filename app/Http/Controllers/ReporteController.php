<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Escuela;
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

    public function get_inscritos_escuela_deporte(Escuela $escuela, Deporte $deporte)
    {
        $inscrito = 1;

        $inscritos = Inscrito::where("escuela_id", "=", $escuela->id)
            ->where("deporte_id", "=", $deporte->id)
            ->where("estado_id", "=", $inscrito)
            ->get();

        return $inscritos;
    }

    public function index(Deporte $deporte)
    {
        $rol = Rol::find(1);
        $roles = $this->get_active_roles();

        $escuela = auth()->user()->escuela;

        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        return view("reporte.index", ["roles" => $roles, "current_rol" => $rol, "escuela" => $escuela, "deporte" => $deporte, "inscritos" => $inscritos]);
    }

    public function inscritos_by_escuela_deporte(Rol $rol, Escuela $escuela, Deporte $deporte)
    {
        $roles = $this->get_active_roles();

        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        return view("reporte.index", ["roles" => $roles, "current_rol" => $rol, "escuela" => $escuela, "deporte" => $deporte, "inscritos" => $inscritos]);
    }
}
