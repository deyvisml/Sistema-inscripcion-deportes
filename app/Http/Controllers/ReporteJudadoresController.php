<?php

namespace App\Http\Controllers;


use App\Models\School;
use App\Models\Deporte;
use App\Models\Facultad;
use App\Models\Inscrito;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReporteJudadoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        http: //127.0.0.1:8000/inscripcion
        $permission_id = 2; // reporte de jugadores
        $this->middleware('checkPermission:' . $permission_id);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $current_permission = Permission::find(2);
        $permissions = $user->permissions();

        $facultad = null;
        $escuela = null;

        $facultades = Facultad::all();
        $escuelas = School::all();

        $group_deportes = array();

        return view("organizador.filtro", ["permissions" => $permissions, "current_permission" => $current_permission, "facultades" => $facultades, "escuelas" => $escuelas, "facultad" => $facultad, "escuela" => $escuela,  "group_deportes" => $group_deportes]);
    }

    public function filter(Request $request)
    {
        $facultad = null;
        $escuela = null;
        $deportes = array();

        if (isset($request->escuela)) {
            $escuela = School::find($request->escuela);
        }

        if (isset($escuela)) {
            $facultad = $escuela->facultad;
            $deportes = Deporte::orderBy("order", "ASC")->get();
        }

        $facultades = Facultad::all();
        $escuelas = School::all();

        $user = auth()->user();
        $current_permission = Permission::find(2);
        $permissions = $user->permissions();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["num_inscritos"] = $this->get_inscritos_escuela_deporte($escuela, $deporte)->count();
        }

        return view("organizador.filtro", ["permissions" => $permissions, "current_permission" => $current_permission, "facultades" => $facultades, "escuelas" => $escuelas, "facultad" => $facultad, "escuela" => $escuela,  "group_deportes" => $group_deportes]);
    }

    public function get_inscritos_escuela_deporte(School $escuela, Deporte $deporte)
    {
        $inscrito = 1;

        $inscritos = Inscrito::where("escuela_id", "=", $escuela->id)
            ->where("deporte_id", "=", $deporte->id)
            ->where("estado_id", "=", $inscrito)
            ->get();

        return $inscritos;
    }

    public function inscritos(School $escuela, Deporte $deporte)
    {
        $reporte_controller = new ReporteController;

        return $reporte_controller->inscritos_by_escuela_deporte($escuela, $deporte);
    }
}
