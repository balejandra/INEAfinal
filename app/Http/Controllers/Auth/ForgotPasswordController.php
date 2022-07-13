<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\Zarpes\NotificacioneController;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request){

        $user = auth()->id();
        $n = new NotificacioneController();
        $subject="Recuperación de contraseña";
        $mensaje="Saludos, se ha realizado una nueva solicitud de contraseña con su usuario, debe revisar su correo electrónico
        y seguir las indicaciones para realizar el restablecimiento de su contraseña.";
        $n->storeNotificaciones($user,$subject,  $mensaje, "General");

    }
}
