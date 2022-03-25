<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vageneral\AgenciaNavieraVigente;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Flash;


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
        $this->middleware('verifiedRole');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'apellidos' => ['string', 'max:255'],
            'tipo_identificacion' => ['required','string', 'max:20'],
            'numero_identificacion' => ['required','string', 'max:20','unique:users'],
            'fecha_nacimiento' => ['date', 'max:50'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo_usuario' => ['string', 'max:20'],
        ],
            [
                'email.unique'=>'Email ya registrado',
                'numero_identificacion.unique'=>'Numero de Identificacion ya registrado',
            ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $input
     * @return \App\Models\User
     */
    protected function create(array $input)
    {

        if ($input['tipo_persona']=="natural"){
        $user = User::create([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'tipo_identificacion' => $input['tipo_identificacion'],
            'numero_identificacion' => $input['numero_identificacion'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario' => 'Usuario web'
        ]);
        $role = Role::where('name', 'Usuario web')->first();
        $user->roles()->sync($role->id);
        event(new Registered($user));
        return $user;
        }else if($input['tipo_persona']=="juridica"){
            $rif=$input['prefijo']."-".$input['numero_identificacion'];
            //dd($rif);
            $naviera=AgenciaNavieraVigente::where('rifemp',$rif)->get()->last();
           // $naviera=AgenciaNavieraVigente::all();
           // dd($naviera);
                if (is_null($naviera)) {
                    $user = User::create([
                        'nombres' => $input['nombres'],
                        'tipo_identificacion' => $input['tipo_identificacion'],
                        'numero_identificacion' => $input['prefijo']."-".$input['numero_identificacion'],
                        'telefono' => $input['telefono'],
                        'direccion' => $input['direccion'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'tipo_usuario' => 'Usuario web'
                    ]);
                    $role = Role::where('name', 'Usuario web')->first();
                    $user->roles()->sync($role->id);
                    event(new Registered($user));
                    return $user;
                }else {
                    $user = User::create([
                        'nombres' => $input['nombres'],
                        'tipo_identificacion' => $input['tipo_identificacion'],
                        'numero_identificacion' => $input['prefijo']."-".$input['numero_identificacion'],
                        'telefono' => $input['telefono'],
                        'direccion' => $input['direccion'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'tipo_usuario' => 'Usuario web'
                    ]);
                    $role = Role::where('id', 8)->first();
                    $user->roles()->sync($role->id);
                    event(new Registered($user));
                    return $user;
                }


        }
    }


}
