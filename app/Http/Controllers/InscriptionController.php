<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Deporte;
use App\Models\Inscrito;
use App\Models\Permission;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $permission_id = 1; // inscribir
        $this->middleware('checkPermission:' . $permission_id);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd("inscription");

        $user = auth()->user();
        $current_permission = Permission::find(1);
        $permissions = $user->permissions();
        $escuela = $user->escuela;

        $deportes = Deporte::orderBy("order", "ASC")->get();

        $group_deportes = array();

        for ($i = 0; $i < count($deportes); $i++) {
            $deporte = $deportes[$i];
            $group_deportes[$i] = array();

            $group_deportes[$i]["deporte"] = $deporte;

            $group_deportes[$i]["num_inscritos"] = $this->get_inscritos_escuela_deporte($escuela, $deporte)->count();
        }

        return view("delegado.inscribir", ["permissions" => $permissions, "current_permission" => $current_permission, "escuela" => $escuela, "group_deportes" => $group_deportes]);
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

    public function sport()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
