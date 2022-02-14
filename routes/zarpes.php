<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('error', function (){
    return view('auth.error'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo



    //-------------------------------------------------------------



    Route::get('/zarpes/permiso_zarpe', function () {
        return view('zarpes.permiso_zarpe.index');
    });

    Route::get('/zarpes/permiso_zarpe/create', function () {
        return view('zarpes.PermisoDeZarpe.create');
    });
    Route::get('/zarpes/permiso_zarpe/show', function () {
        return view('zarpes.permiso_zarpe.show');
    });


    Route::resource('permisosestadia', \App\Http\Controllers\Zarpes\PermisoEstadiaController::class);
    //Route::resource('permisoszarpe', \App\Http\Controllers\Zarpes\PermisoZarpeController::class);

   // Route::get('/zarpes/permisoszarpes', [PermisoZarpeController::class,'index'])->name('permisoszarpes.index');
    Route::get('/zarpes/permisoszarpes', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'index'])->name('permisoszarpes.index')->middleware('auth');
    Route::get('/zarpes/permisoszarpes/create-step-one', [PermisoZarpeController::class,'createStepOne'])->name('permisoszarpes.create.step.one');

    Route::post('permisoszarpes/create-step-one', [PermisoZarpeController::class,'postCreateStepOne'])->name('permisoszarpes.create.step.one.post');

    Route::get('permisoszarpes/create-step-two', [PermisoZarpeController::class,'createStepTwo'])->name('permisoszarpess.create.step.two');

    Route::post('permisoszarpes/create-step-two', [PermisoZarpeController::class,'postCreateStepTwo'])->name('permisoszarpes.create.step.two.post');

    Route::get('permisoszarpes/create-step-three', [PermisoZarpeController::class,'createStepThree'])->name('permisoszarpes.create.step.three');

    Route::post('permisoszarpes/create-step-three', [PermisoZarpeController::class,'postCreateStepThree'])->name('permisoszarpes.create.step.three.post');

    Route::get('permisoszarpes/create-step-four', [PermisoZarpeController::class,'createStepFour'])->name('permisoszarpes.create.step.four');

    Route::post('permisoszarpes/create-step-four', [PermisoZarpeController::class,'postCreateStepFour'])->name('permisoszarpe.create.step.four.post');
    Route::get('permisoszarpes/create-step-five', [PermisoZarpeController::class,'createStepFive'])->name('permisoszarpes.create.step.five');

    Route::post('permisoszarpes/create-step-five', [PermisoZarpeController::class,'postCreateStepFive'])->name('permisoszarpe.create.step.five.post');
    Route::get('permisoszarpes/create-step-six', [PermisoZarpeController::class,'createStepSix'])->name('permisoszarpes.create.step.six');

    Route::post('permisoszarpes/create-step-six', [PermisoZarpeController::class,'postCreateStepSix'])->name('permisoszarpes.create.step.six.post');


});
