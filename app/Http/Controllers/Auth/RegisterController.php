<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['string', 'max:255'],
            'tipo_documento' => ['string', 'max:20'],
            'numero_identificacion' => ['string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date', 'max:50'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo_usuario'=>['string', 'max:20'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    protected function create(array $input)
    {
         $user= User::create([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'tipo_documento' => $input['tipo_documento'],
            'numero_identificacion' => $input['numero_identificacion'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario' =>'Web'
        ]);

        $roles='2';
        $user->roles()->sync($roles);
        return $user;
    }
}
