<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use App\Models\School;
use App\Models\Deporte;
use App\Models\Inscrito;
use PDF;
use App\Models\Permission;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Deporte $deporte)
    {
        $user = auth()->user();
        $current_permission = Permission::find(1);
        $permissions = $user->permissions();
        $escuela = $user->escuela;

        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        return view("reporte.index", ["permissions" => $permissions, "current_permission" => $current_permission, "escuela" => $escuela, "deporte" => $deporte, "inscritos" => $inscritos]);
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

    public function inscritos_by_escuela_deporte(School $escuela, Deporte $deporte)
    {
        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        $user = auth()->user();
        $current_permission = Permission::find(2);
        $permissions = $user->permissions();

        return view("reporte.index", ["permissions" => $permissions, "current_permission" => $current_permission, "escuela" => $escuela, "deporte" => $deporte, "inscritos" => $inscritos]);
    }


    public function generatePDF(Deporte $deporte)
    {
        $escuela = auth()->user()->escuela;
        $facultad = $escuela->facultad;
        $inscritos = $this->get_inscritos_escuela_deporte($escuela, $deporte);

        $data = [
            'facultad' => $facultad,
            'escuela' => $escuela,
            'deporte' => $deporte,
            'inscritos' => $inscritos,
            'date' => date('m/d/Y'),
        ];

        //return view("reporte.pdf", $data);
        $pdf = PDF::loadView('reporte.pdf', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download($escuela->name . " - " . $deporte->name . '.pdf');
    }
}
