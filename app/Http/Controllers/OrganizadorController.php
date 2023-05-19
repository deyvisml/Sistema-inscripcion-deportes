<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Inscrito;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpOption\None;

class OrganizadorController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user && $user->tipo_id === 2) {
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
        switch ($rol->id) {
            case '3':
                return $this->filtro($rol, new Request());
                break;

            default:
                return redirect()->route('organizador.index');
                break;
        }
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

    public function filtro(Rol $rol, Request $request)
    {
        $facultad = null;
        $escuela = null;
        $deportes = array();

        if (isset($request->escuela)) {
            $escuela = Escuela::find($request->escuela);
        }

        if (isset($escuela)) {
            $facultad = $escuela->facultad;
            $deportes = Deporte::orderBy("name", "ASC")->get();
        }

        $roles = $this->get_active_roles();

        $facultades = Facultad::all();
        $escuelas = Escuela::all();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["num_inscritos"] = $this->get_inscritos_escuela_deporte($escuela, $deporte)->count();
        }

        return view("organizador.filtro", ["roles" => $roles, "current_rol" => $rol, "facultades" => $facultades, "escuelas" => $escuelas, "facultad" => $facultad, "escuela" => $escuela,  "group_deportes" => $group_deportes]);
    }

    public function inscritos(Rol $rol, Escuela $escuela, Deporte $deporte)
    {
        $reporte_controller = new ReporteController;

        return $reporte_controller->inscritos_by_escuela_deporte($rol, $escuela, $deporte);
    }
}
