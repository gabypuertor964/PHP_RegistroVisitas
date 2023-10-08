<?php

use App\Http\Controllers\Admin\areasController;
use App\Http\Controllers\Admin\permisosController;
use App\Http\Controllers\Admin\rolesController;
use App\Http\Controllers\Admin\trabajadoresController;
use Illuminate\Support\Facades\Route;

//Dasboard Principal Admin
Route::get("",function(){
    return view("admin.home");
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

    //Controlador CRUD Trabajadores
    Route::resource('/trabajadores',trabajadoresController::class)->except("destroy")->middleware("can:trabajadores");

    //Controlador CRUD Areas
    Route::resource('/areas', areasController::class)->except("destroy")->middleware("can:areas");
});

