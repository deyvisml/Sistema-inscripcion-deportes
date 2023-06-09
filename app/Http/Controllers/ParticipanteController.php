<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rol;
use App\Models\User;
use App\Models\Acceso;
use App\Models\Deporte;
use App\Models\Inscrito;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
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

    public function index(Rol $rol, Deporte $deporte)
    {
        $fechaLimite = Carbon::parse($deporte->fecha_limite);

        if ($fechaLimite->isPast()) {
            // La fecha límite ha pasado
            return redirect()->route('user.index');
        }

        $roles = $this->get_active_roles();

        $inscritos = $this->get_inscritos_deporte($deporte);

        return view("user.participantes", ["roles" => $roles, "current_rol" => $rol, "deporte" => $deporte, "inscritos" => $inscritos]);
    }

    public function formulario(Rol $rol, Deporte $deporte)
    {
        $roles = $this->get_active_roles();

        return view("user.formulario_inscripcion", ["roles" => $roles, "current_rol" => $rol, "deporte" => $deporte]);
    }

    public function store(Rol $rol, Deporte $deporte, Request $request)
    {
        $fechaLimite = Carbon::parse($deporte->fecha_limite);

        if ($fechaLimite->isPast()) {
            // La fecha límite ha pasado
            return redirect()->route('user.index');
        }

        $roles = $this->get_active_roles();

        $validated = $request->validate([
            "codigo" => "required|numeric|digits:6",
            'name' => 'required|max:150',
            'ap_paterno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
        ]);

        // verificar si ya se llego al maximo numero de inscritos
        $inscritos = $this->get_inscritos_deporte($deporte);

        if ($inscritos->count() >= $deporte->num_max_players) {
            return redirect()->back()->with("error_num_limit_players", "Error, ya se alcanzó el numero maximo de participantes para este deporte.");
        }

        $user = auth()->user();
        $escuela = $user->escuela;

        $user = Inscrito::create([
            "codigo" => $request["codigo"],
            "name" => $request["name"],
            "ap_paterno" => $request["ap_paterno"],
            "ap_materno" => $request["ap_materno"],
            "user_id" => $user->id,
            "escuela_id" => $escuela->id,
            "deporte_id" => $deporte->id,
            "estado_id" => 1,
        ]);

        return redirect()->route("participante.index", ["roles" => $roles, "rol" => $rol, "deporte" => $deporte])->with("inscripcion_success", "El registro fue exitoso.");
    }

    public function editar(Rol $rol, Deporte $deporte, Inscrito $inscrito)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);
        if ($inscrito->user_id != auth()->user()->id) {
            return redirect()->route("login");
        }

        $roles = $this->get_active_roles();

        return view("user.participante_editar", ["roles" => $roles, "current_rol" => $rol, "deporte" => $deporte, "inscrito" => $inscrito]);
    }

    public function update(Rol $rol, Deporte $deporte, Inscrito $inscrito, Request $request)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);
        if ($inscrito->user_id != auth()->user()->id) {
            return redirect()->route("login");
        }

        $roles = $this->get_active_roles();

        $validated = $request->validate([
            "codigo" => "required|numeric|digits:6",
            'name' => 'required|max:150',
            'ap_paterno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
        ]);

        $inscrito->update([
            "codigo" => $request["codigo"],
            "name" => $request["name"],
            "ap_paterno" => $request["ap_paterno"],
            "ap_materno" => $request["ap_materno"]
        ]);

        return redirect()->route("participante.index", ["roles" => $roles, "rol" => $rol, "deporte" => $deporte])->with("update_success", "Se actualizó exitosamente.");
    }

    public function delete(Rol $rol, Deporte $deporte, Inscrito $inscrito)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);
        if ($inscrito->user_id != auth()->user()->id) {
            return redirect()->route("login");
        }

        $roles = $this->get_active_roles();

        $inscrito->update([
            "estado_id" => 2,
            "deleted_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route("participante.index", ["roles" => $roles, "rol" => $rol, "deporte" => $deporte])->with("delete_success", "Se elimininó exitosamente.");
    }
}
