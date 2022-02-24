<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('error', function (){
    return view('auth.error'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo



    //-------------------------------------------------------------



    Route::resource('tablaMandos', \App\Http\Controllers\Zarpes\TablaMandoController::class);


    Route::get('/zarpes/permisosDeZarpe', function () {
        return view('zarpes.PermisoDeZarpe.index');
    });

    Route::get('/zarpes/permisosDeZarpe/create', function () {
        return view('zarpes.PermisoDeZarpe.index');
    });
    Route::get('validationStepTwo',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validationStepTwo'])->name('validationStepTwo');


    Route::resource('permisosestadia', \App\Http\Controllers\Zarpes\PermisoEstadiaController::class);
    //Route::resource('permisoszarpes', \App\Http\Controllers\Zarpes\PermisoZarpeController::class);
    Route::get('update/{id}/{status}', [\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'updateStatus'])->name('status');


    Route::get('/zarpes/permisoszarpes', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'index'])->name('permisoszarpes.index')->middleware('auth');

    Route::get('/zarpes/permisoszarpes/createStepOne', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepOne'])->name('permisoszarpes.createStepOne');

    Route::post('permisoszarpes/createStepOne', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepOne'])->name('permisoszarpes.permissionCreateStepOne');

    Route::get('permisoszarpes/create-step-two', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'CreateStepTwo'])->name('permisoszarpes.CreateStepTwo');

    Route::post('permisoszarpes/create-step-two', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateSteptwo'])->name('permisoszarpes.permissionCreateSteptwo');

    Route::get('permisoszarpes/create-step-twoE', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'CreateStepTwoE'])->name('permisoszarpes.CreateStepTwoE');

    Route::post('permisoszarpes/create-step-twoE', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateSteptwoE'])->name('permisoszarpes.permissionCreateSteptwoE');

    Route::get('permisoszarpes/create-step-three', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepThree'])->name('permisoszarpes.createStepThree');

    Route::post('permisoszarpes/create-step-three', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepThree'])->name('permisoszarpes.permissionCreateStepThree');

    Route::get('permisoszarpes/create-step-four', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepFour'])->name('permisoszarpes.createStepFour');

    Route::post('permisoszarpes/create-step-four', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepFour'])->name('permisoszarpes.permissionCreateStepFour');

    Route::get('permisoszarpes/create-step-five', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepFive'])->name('permisoszarpes.createStepFive');

    Route::post('permisoszarpes/create-step-five', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepFive'])->name('permisoszarpes.permissionCreateStepFive');

    Route::get('permisoszarpes/create-step-six', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepSix'])->name('permisoszarpes.createStepSix');

    Route::post('permisoszarpes/create-step-six', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepSix'])->name('permisoszarpes.permissionCreateStepSix');

    Route::get('permisoszarpes/create-step-seven', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepSeven'])->name('permisoszarpes.createStepSeven');

    Route::post('permisoszarpes/create-step-seven', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'store'])->name('permisoszarpes.store');

     Route::get('permisoszarpes/{permisoszarpe}', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'show'])->name('permisoszarpes.show');


    Route::get('consultasaime2',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'consulta2'])->name('consultasaime2');

    Route::get('validarMarino',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validarMarino'])->name('validarMarino');



});
