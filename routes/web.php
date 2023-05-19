<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// manejador general
Route::get("/", [HandlerController::class, "index"])->name("handler.index");

Route::get("/register", [RegisterController::class, "index"])->name("register.index");

Route::post("/register", [RegisterController::class, "store"])->name("register.store");

Route::get("/login", [AuthController::class, "index"])->name("login");

Route::post("/login", [AuthController::class, "store"])->name("login.store");

Route::get("/logout", [AuthController::class, "logout"])->name("login.logout");


// manejador especeficio
Route::get("/organizador", [OrganizadorController::class, "index"])->name("organizador.index");
Route::post("/organizador/{rol}", [OrganizadorController::class, "filtro"])->name("organizador.filter");
Route::get("/organizador/{rol}/escuelas/{escuela}/deportes/{deporte}", [OrganizadorController::class, "inscritos"])->name("organizador.inscritos"); // todo: working in this



Route::get("/reportes/escuelas/{escuela}/deportes/{deporte}/pdf", [PDFController::class, "generatePDF"])->name("reporte.pdf");

// manejador especeficio
Route::get("/delegado", [UserController::class, "index"])->name("delegado.index");
Route::get("/delegado/{rol:url}", [UserController::class, "index"])->name("delegado.handler");

Route::get("/delegado/escuelas/{escuela}/deportes/{deporte}", [UserController::class, "inscritos"])->name("delegado.inscritos");

Route::get("/delegado/{rol:url}/{deporte}", [ParticipanteController::class, "index"])->name("participante.index");

Route::get("/delegado/{rol:url}/{deporte}/formulario", [ParticipanteController::class, "formulario"])->name("participante.formulario");

Route::post("/delegado/{rol:url}/{deporte}/formulario", [ParticipanteController::class, "store"])->name("participante.store");

Route::get("/delegado/{rol:url}/{deporte}/editar/{inscrito}", [ParticipanteController::class, "editar"])->name("participante.editar");

Route::post("/delegado/{rol:url}/{deporte}/editar/{inscrito}", [ParticipanteController::class, "update"])->name("participante.editar");

Route::get("/delegado/{rol:url}/{deporte}/delete/{inscrito}", [ParticipanteController::class, "delete"])->name("participante.borrar");

Route::get("/reporte_jugadores", [UserController::class, "reporte_jugadores"])->name("reporte_jugadores");
