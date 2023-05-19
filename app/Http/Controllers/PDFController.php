<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Escuela;
use App\Models\Inscrito;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user) {
                return $next($request);
            }

            abort(403, 'No tienes permisos para acceder a esta página.');
        });
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

    public function generatePDF(Escuela $escuela, Deporte $deporte)
    {
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
