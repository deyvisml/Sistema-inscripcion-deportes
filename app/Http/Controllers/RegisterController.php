<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $facultades = Facultad::orderBy("name", "ASC")->get();
        $escuelas = Escuela::orderBy("name", "ASC")->get();

        return view("auth/register", ["facultades" => $facultades, "escuelas" => $escuelas]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user' => 'required|string|max:20|min:5|unique:users',
            'password' => 'required|string|max:20|min:5',
            'name' => 'required|max:150',
            'ap_paterno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
            'ap_materno' => 'required|max:150',
            'facultad' => 'required|integer|between:1,10',
            'escuela' => 'required|integer|between:1,24',
        ]);

        //dd($request["facultad"]);

        $user = User::create([
            "user" => $request["user"],
            "password" => bcrypt($request["password"]),
            "name" => $request["name"],
            "ap_paterno" => $request["ap_paterno"],
            "ap_materno" => $request["ap_materno"],
            "escuela_id" => $request["escuela"],
            "tipo_id" => 1,
        ]);

        return redirect()->route("login.index")->with("register_success", "Usuario registrado.");;
    }
}
