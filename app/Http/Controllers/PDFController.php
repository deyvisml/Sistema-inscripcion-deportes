<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Inscrito;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function generatePDF(Deporte $deporte)
    {
        $escuela = auth()->user()->escuela;
        $facultad = $escuela->facultad;
        $inscritos = $this->get_inscritos_deporte($deporte);

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
