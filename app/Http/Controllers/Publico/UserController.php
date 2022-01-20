<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publico\CreateUserRequest;
use App\Http\Requests\Publico\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Publico\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
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
        return view('publico.users.create')->with('roles',$roles);
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
        $data= new User();
        $data->email= $request->email;
        $data->nombres = $request->nombres;
        $data->password = Hash::make($request->password);
        $data->tipo_usuario=$request->tipo_usuario;
        $data->save();
        $input = $request->all();

        $roles=$input['roles'] ;
        $data->roles()->sync($roles);
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
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('publico.users.edit')
            ->with('user', $user)
            ->with('roles',$roles);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);
        $roles=$request->roles ;
        $user->roles()->sync($roles);

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
}
