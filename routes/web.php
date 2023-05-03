<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [AuthController::class, "index"])->name("login");

Route::get("/register", [RegisterController::class, "index"])->name("register.index");

Route::post("/register", [RegisterController::class, "store"])->name("register.store");

Route::get("/login", [AuthController::class, "index"])->name("login");

Route::post("/login", [AuthController::class, "store"])->name("login.store");

Route::get("/logout", [AuthController::class, "logout"])->name("login.logout");



Route::get("/inicio", [UserController::class, "index"])->name("user.index");

// manejador urls
Route::get("/{rol:url}", [UserController::class, "handler"])->name("user.handler");

//Route::get("/inscribir", [UserController::class, "inscribir"])->name("inscribir");

Route::get("/reporte_jugadores", [UserController::class, "reporte_jugadores"])->name("reporte_jugadores");
