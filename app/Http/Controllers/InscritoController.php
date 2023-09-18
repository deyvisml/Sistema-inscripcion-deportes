<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rol;
use App\Models\Acceso;
use App\Models\School;
use App\Models\Deporte;
use App\Models\Inscrito;
use App\Models\Permission;
use Illuminate\Http\Request;

class InscritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $permission_id = 1; // inscribir
        $this->middleware('checkPermission:' . $permission_id);
    }

    public function index(Deporte $deporte)
    {
        $user = auth()->user();
        $current_permission = Permission::find(1);
        $permissions = $user->permissions();

        $fecha_limite = Carbon::parse($deporte->fecha_limite);

        if ($fecha_limite->isPast()) {
            // La fecha límite ha pasado
            return redirect()->route('inscription.index');
        }

        $escuela = auth()->user()->escuela;

        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        return view("inscrito.index", ["permissions" => $permissions, "current_permission" => $current_permission, "deporte" => $deporte, "inscritos" => $inscritos]);
    }

    public function create(Deporte $deporte)
    {
        $user = auth()->user();
        $current_permission = Permission::find(1);
        $permissions = $user->permissions();

        return view("inscrito.create", ["permissions" => $permissions, "current_permission" => $current_permission, "deporte" => $deporte]);
    }

    public function store(Deporte $deporte, Request $request)
    {
        $fecha_limite = Carbon::parse($deporte->fecha_limite);

        if ($fecha_limite->isPast()) {
            // La fecha límite ha pasado
            return redirect()->route('inscription.index');
        }

        $request->validate([
            "codigo" => "required|numeric|digits:6",
            'name' => 'required|max:150',
            'ap_paterno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
            'dni' => 'required|numeric|digits:8',
        ]);

        $user = auth()->user();
        $escuela = $user->escuela;

        // verificar si ya se llego al maximo numero de inscritos
        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        if ($inscritos->count() >= $deporte->num_max_players) {
            return redirect()->back()->with("error_num_limit_players", "Error, ya se alcanzó el numero maximo de participantes para este deporte.");
        }

        $escuela = $user->escuela;

        $inscrito = Inscrito::create([
            "codigo" => $request["codigo"],
            "name" => $request["name"],
            "ap_paterno" => $request["ap_paterno"],
            "ap_materno" => $request["ap_materno"],
            "dni" => $request["dni"],
            "user_id" => $user->id,
            "escuela_id" => $escuela->id,
            "deporte_id" => $deporte->id,
            "estado_id" => 1,
        ]);

        return redirect()->route("inscrito.index", ["deporte" => $deporte])->with("inscripcion_success", "El registro fue exitoso.");
    }

    public function edit(Deporte $deporte, Inscrito $inscrito)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);

        $user = auth()->user();

        if ($inscrito->user_id != $user->id) {
            return redirect()->route("login");
        }

        $current_permission = Permission::find(1); // 1 means inscription
        $permissions = $user->permissions();

        return view("inscrito.edit", ["permissions" => $permissions, "current_permission" => $current_permission, "deporte" => $deporte, "inscrito" => $inscrito]);
    }

    public function update(Deporte $deporte, Inscrito $inscrito, Request $request)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);

        $user = auth()->user();

        if ($inscrito->user_id != $user->id) {
            return redirect()->route("login");
        }

        $request->validate([
            "codigo" => "required|numeric|digits:6",
            'name' => 'required|max:150',
            'ap_paterno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
            'dni' => 'required|numeric|digits:8',
        ]);

        $inscrito->update([
            "codigo" => $request["codigo"],
            "name" => $request["name"],
            "ap_paterno" => $request["ap_paterno"],
            "ap_materno" => $request["ap_materno"],
            'dni' => $request["dni"],
        ]);

        return redirect()->route("inscrito.index", ["deporte" => $deporte])->with("update_success", "Se actualizó exitosamente.");
    }

    public function delete(Deporte $deporte, Inscrito $inscrito)
    {
        $inscrito = Inscrito::findOrFail($inscrito->id);

        $escuela = auth()->user()->escuela;

        if ($inscrito->escuela_id != $escuela->id) {
            return redirect()->route("login");
        }

        $inscrito->update([
            "estado_id" => 2,
            "deleted_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route("inscrito.index", ["deporte" => $deporte])->with("delete_success", "Se elimininó exitosamente.");
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
}
