<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('error', function (){
    return view('auth.error'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo


    //-------------------------------------------------------------



    Route::get('/zarpes/permisosDeZarpe', function () {
        return view('zarpes.PermisoDeZarpe.index');
    });

    Route::get('/zarpes/permisosDeZarpe/create', function () {
        return view('zarpes.PermisoDeZarpe.create');
    });
    Route::get('/zarpes/permisosDeZarpe/show', function () {
        return view('zarpes.PermisoDeZarpe.show');
    });
     

});
