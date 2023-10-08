<?php

use App\Http\Controllers\Workers\equiposController;
use App\Http\Controllers\Workers\visitantesController;
use App\Http\Controllers\Workers\visitasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Acceso a Dashboard Principal
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Controlador CRUD Equipos
    Route::resource("/equipos",equiposController::class)->except("destroy,show");

    //Controlador CRUD Visitantes
    Route::resource("/visitantes",visitantesController::class)->except("destroy");

    //Controlador CRUD Visitas
    Route::resource("/visitas",visitasController::class)->except("destroy","create");

    Route::controller(visitasController::class)->group(function(){
        Route::post('/visitas/create','create')->name("visitas.create");

        Route::get('/visitas/salida/{id}','registrar_salida')->name("visitas.salida");
    });
});