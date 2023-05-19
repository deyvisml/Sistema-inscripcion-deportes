<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view("auth/login");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "user" => "required",
            "password" => "required"
        ]);

        if (!auth()->attempt($request->only("user", "password"))) {
            return back()->with("message", "Credenciales incorrectas");
        }

        return redirect()->route("handler.index");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
