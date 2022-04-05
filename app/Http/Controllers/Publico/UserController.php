<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publico\CreateUserRequest;
use App\Http\Requests\Publico\UpdateUserRequest;
use App\Models\Publico\Capitania;
use App\Models\Publico\CapitaniaUser;
use App\Models\Publico\Saime_cedula;
use App\Models\User;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\EstablecimientoNauticoUser;
use App\Repositories\Publico\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;


        $this->middleware('permission:listar-usuario', ['only'=>['index'] ]);
        $this->middleware('permission:crear-usuario', ['only'=>['create','store']]);
        $this->middleware('permission:editar-usuario', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-usuario', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-usuario', ['only'=>['destroy'] ]);
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        return view('publico.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id');
        $capitanias=Capitania::pluck('nombre','id');
        return view('publico.users.create')
            ->with('roles',$roles)
            ->with('capitanias',$capitanias);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $validated= $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => [
                'required',
                'max:50',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->uncompromised(),
            ],
        ],
            [
                'email.unique'=>'Email ya registrado',
            ]);

        $data= new User();
        $data->email= $request->email;
        $data->nombres = $request->nombres;
        $data->password = Hash::make($request->password);
        $data->tipo_usuario=$request->tipo_usuario;
        $data->email_verified_at= now();
        $data->save();

        $roles=$request->input('roles', []);
        $data->roles()->sync($roles);
        $rol=Role::select('name')->where('id',$request->roles)->get();

        if (($request->roles==5)||($request->roles==6)) {
            if ($request->establecimientos) {
                $cap_user= new CapitaniaUser();
                $cap_user->cargo=$rol[0]->name;
                $cap_user->user_id=$data->id;
                $cap_user->capitania_id=$request->capitanias;
                $cap_user->save();

                $est_user= new EstablecimientoNauticoUser();
                $est_user->user_id=$data->id;
                $est_user->establecimiento_nautico_id=$request->establecimientos;
                $est_user->save();
            }else {
                Flash::error('Debe seleccionar un establecimiento nautico.');
                return redirect()->back();
            }

        } elseif (($request->roles==4)||($request->roles==7)||($request->roles==8)){

            $cap_user= new CapitaniaUser();
            $cap_user->cargo=$rol[0]->name;
            $cap_user->user_id=$data->id;
            $cap_user->capitania_id=$request->capitanias;
            $cap_user->save();
        }

        Flash::success('Usuario guardado exitosamente.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('publico.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roles=Role::pluck('name','id');
        $capitanias=Capitania::pluck('nombre','id');
        $user = $this->userRepository->find($id);
        $establecimientos=EstablecimientoNautico::pluck('nombre','id');

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('publico.users.edit')
            ->with('user', $user)
            ->with('roles',$roles)
            ->with('capitanias',$capitanias)
            ->with('establecimientos',$establecimientos);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validated= $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        $user= User::find($id);
        $user->email= $request->email;
        $user->nombres = $request->nombres;
        if ($request->password_change) {
            $validated= $request->validate([
                'nombres' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => [
                    'required',
                    'max:50',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->uncompromised(),
                ],
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->tipo_usuario=$request->tipo_usuario;
        $user->email_verified_at= now();
        $user->update();
        $roles=$request->roles ;
        $user->roles()->sync($roles);
        $rol=Role::select('name')->where('id',$request->roles)->get();
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        if (($request->roles==5)||($request->roles==6)) {
            if ($request->establecimientos) {
                $cap_user= new CapitaniaUser();
                $cap_user->cargo=$rol[0]->name;
                $cap_user->user_id=$id;
                $cap_user->capitania_id=$request->capitanias;
                $cap_user->save();

                $est_user= new EstablecimientoNauticoUser();
                $est_user->user_id=$id;
                $est_user->establecimiento_nautico_id=$request->establecimientos;
                $est_user->save();
            }else {
                Flash::error('Debe seleccionar un establecimiento nautico.');
                return redirect()->back();
            }

        } elseif (($request->roles==4)||($request->roles==7)||($request->roles==8)){

            $cap_user= new CapitaniaUser();
            $cap_user->cargo=$rol[0]->name;
            $cap_user->user_id=$id;
            $cap_user->capitania_id=$request->capitanias;
            $cap_user->save();
        }

        Flash::success('Usuario actualizado con éxito.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('Usuario eliminado exitosamente.');

        return redirect(route('users.index'));
    }

    public function consulta(Request $request){
        $cedula=$_REQUEST['cedula'];
        $fecha=$_REQUEST['fecha'];
        $newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-m-d", strtotime($fecha));
        $data= Saime_cedula::where('cedula',$cedula)
            ->whereIn('fecha_nacimiento',[$newDate,$newDate2,$newDate3])
            ->get();
        if (is_null($data->first())) {
           // dd('error');
            $data=response()->json([
                'status'=>3,
                'msg' => $exception->getMessage(),
                'errors'=>[],
            ], 200);
        }
            echo json_encode($data);
    }

    public function EstablecimientoUser(Request $request){
        $idcap= $_REQUEST['idcap'];
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $idcap)->get();
        $resp=[$EstNauticos];
        echo json_encode($resp);
    }

}
