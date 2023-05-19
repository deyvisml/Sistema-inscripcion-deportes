<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acceso;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipo_usuario = auth()->user()->tipo_id;

        return $this->handler($tipo_usuario);
    }

    public function handler($tipo_usuario)
    {
        switch ($tipo_usuario) {
            case '1':
                $user_controller = new UserController;
                return $user_controller->index();
                break;
            case '2':
                $organizador_controller = new OrganizadorController;
                return $organizador_controller->index();
            default:
                // si el id rol es desconocido
                break;
        }
    }
}
