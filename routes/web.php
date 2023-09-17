<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\InscritoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ReporteJudadoresController;

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


/* ======== FIXING THE ROUTES ========*/

Route::get("/inscripcion", [InscriptionController::class, "index"])->name("inscription.index");

Route::get("/inscripcion/inscritos/deporte/{deporte}", [InscritoController::class, "index"])->name("inscrito.index");

Route::get("/inscripcion/inscritos/deporte/{deporte}/inscribir", [InscritoController::class, "create"])->name("inscrito.create");
Route::post("/inscripcion/inscritos/deporte/{deporte}/inscribir", [InscritoController::class, "store"])->name("inscrito.store");

Route::get("/inscripcion/inscritos/deporte/{deporte}/editar/{inscrito}", [InscritoController::class, "edit"])->name("inscrito.edit");
Route::post("/inscripcion/inscritos/deporte/{deporte}/editar/{inscrito}", [InscritoController::class, "update"])->name("inscrito.update");

Route::get("/inscripcion/inscritos/deporte/{deporte}/eliminar/{inscrito}", [InscritoController::class, "delete"])->name("inscrito.delete");

Route::get("/inscripcion/inscritos/reporte/deporte/{deporte}", [ReporteController::class, "index"])->name("reporte.index");

Route::get("/inscripcion/inscritos/reporte/deporte/{deporte}/pdf", [ReporteController::class, "generatePDF"])->name("reporte.pdf");

/* ============================ */

Route::get("/reporte_jugadores", [ReporteJudadoresController::class, "index"])->name("reporte_jugadores.index");

Route::post("/reporte_jugadores/filtro", [ReporteJudadoresController::class, "filter"])->name("reporte_jugadores.filter");

Route::get("/reporte_jugadores/escuelas/{escuela}/deportes/{deporte}", [ReporteJudadoresController::class, "inscritos"])->name("reporte_jugadores.inscritos"); // todo: working in this
