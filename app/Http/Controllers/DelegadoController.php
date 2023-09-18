<?php

namespace App\Http\Controllers;

use App\Models\Delegado;
use App\Models\School;
use App\Models\Deporte;
use App\Models\Permission;
use Illuminate\Http\Request;

class DelegadoController extends Controller
{
    private $permission_id;
    public function __construct()
    {
        $this->middleware('auth');

        $this->permission_id = 3; // inscripción delegados
        $this->middleware('checkPermission:' . $this->permission_id);
    }

    public function index()
    {
        $user = auth()->user();
        $current_permission = Permission::find($this->permission_id);
        $permissions = $user->permissions();
        $escuela = $user->escuela;

        $deportes = Deporte::orderBy("order", "ASC")->get();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["delegado"] = $this->get_delegado_escuela_deporte($escuela, $deporte);
        }

        return view("delegado.index", ["permissions" => $permissions, "current_permission" => $current_permission, "escuela" => $escuela, "group_deportes" => $group_deportes]);
    }

    public function create(Deporte $deporte)
    {
        $user = auth()->user();
        $current_permission = Permission::find($this->permission_id);
        $permissions = $user->permissions();

        $escuela = auth()->user()->escuela;

        return view("delegado.create", ["permissions" => $permissions, "current_permission" => $current_permission, "deporte" => $deporte]);
    }

    public function store(Deporte $deporte, Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            "code" => "required|numeric|digits:6",
            'dni' => 'required|numeric|digits:8',
            'phone_number' => 'required',
        ]);

        $user = auth()->user();
        $escuela = $user->escuela;

        Delegado::create([
            "name" => $request["name"],
            "code" => $request["code"],
            "dni" => $request["dni"],
            "phone_number" => $request["phone_number"],
            "escuela_id" => $escuela->id,
            "deporte_id" => $deporte->id,
            "user_id" => $user->id,
        ]);

        return redirect()->route("delegado.index")->with("inscripcion_success", "El registro fue exitoso.");
    }

    public function edit(Delegado $delegado)
    {
        $delegado = Delegado::findOrFail($delegado->id);
        $deporte = Deporte::find($delegado->deporte_id);

        $user = auth()->user();

        if ($delegado->user_id != $user->id) {
            return redirect()->route("login");
        }

        $current_permission = Permission::find(1); // 1 means inscription
        $permissions = $user->permissions();

        return view("delegado.edit", ["permissions" => $permissions, "current_permission" => $current_permission, "deporte" => $deporte, "delegado" => $delegado]);
    }

    public function update(Delegado $delegado, Request $request)
    {
        $delegado = Delegado::findOrFail($delegado->id);

        $user = auth()->user();

        if ($delegado->user_id != $user->id) {
            return redirect()->route("login");
        }

        $request->validate([
            'name' => 'required|max:200',
            "code" => "required|numeric|digits:6",
            'dni' => 'required|numeric|digits:8',
            'phone_number' => 'required',
        ]);

        $delegado->update([
            "name" => $request["name"],
            "code" => $request["code"],
            "dni" => $request["dni"],
            "phone_number" => $request["phone_number"],
        ]);

        return redirect()->route("delegado.index")->with("update_success", "Se actualizó exitosamente.");
    }

    public function get_delegado_escuela_deporte(School $escuela, Deporte $deporte)
    {
        $delegado = Delegado::where("escuela_id", "=", $escuela->id)
            ->where("deporte_id", "=", $deporte->id)
            ->first();

        return $delegado;
    }
}
