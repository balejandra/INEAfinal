<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\CreateCapitaniaUserRequest;
use App\Http\Requests\Publico\UpdateCapitaniaUserRequest;
use App\Models\Publico\Capitania;
use App\Models\Publico\CapitaniaUser;
use App\Models\User;
use App\Repositories\Publico\CapitaniaUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CapitaniaUserController extends AppBaseController
{
    /** @var  CapitaniaUserRepository */
    private $capitaniaUserRepository;

    public function __construct(CapitaniaUserRepository $capitaniaUserRepo)
    {
        $this->capitaniaUserRepository = $capitaniaUserRepo;
    }

    /**
     * Display a listing of the CapitaniaUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $capitaniaUsers = $this->capitaniaUserRepository->all();

        return view('publico.capitania_users.index')
            ->with('capitaniaUsers', $capitaniaUsers);
    }

    /**
     * Show the form for creating a new CapitaniaUser.
     *
     * @return Response
     */
    public function create()
    {
        $user2=User::pluck('email','id');
        $capitanias=Capitania::pluck('nombre','id');
        $roles=Role::pluck('name','id');
        return view('publico.capitania_users.create')
            ->with('users',$user2)
            ->with('capitania',$capitanias)
            ->with('roles',$roles);
    }

    /**
     * Store a newly created CapitaniaUser in storage.
     *
     * @param CreateCapitaniaUserRequest $request
     *
     * @return Response
     */
    public function store(CreateCapitaniaUserRequest $request)
    {
        $verification=CapitaniaUser::where('cargo',$request->cargo)->where('capitania_id',$request->capitania_id)->get();
        if (isset($verification[0])) {
            Flash::error('La capitania ya tiene asignado este rol.');
            return redirect()->back();
        }else {
            $input = $request->all();

            $capitaniaUser = $this->capitaniaUserRepository->create($input);

            Flash::success('Capitania User saved successfully.');

            return redirect(route('capitaniaUsers.index'));
        }

    }

    /**
     * Display the specified CapitaniaUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Capitania User not found');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('publico.capitania_users.show')->with('capitaniaUser', $capitaniaUser);
    }

    /**
     * Show the form for editing the specified CapitaniaUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);
        $user2=User::pluck('email','id');
        $capitanias=Capitania::pluck('nombre','id');
        $roles=Role::pluck('name','id');

        if (empty($capitaniaUser)) {
            Flash::error('Capitania User not found');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('publico.capitania_users.edit')
            ->with('capitaniaUser', $capitaniaUser)
            ->with('users',$user2)
            ->with('capitania',$capitanias)
            ->with('roles',$roles);
    }

    /**
     * Update the specified CapitaniaUser in storage.
     *
     * @param int $id
     * @param UpdateCapitaniaUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCapitaniaUserRequest $request)
    {
        $verification=CapitaniaUser::where('cargo',$request->cargo)->where('capitania_id',$request->capitania_id)->get();
        $ver=$verification->except([$id]);
        if (isset($ver[0])) {
            Flash::error('La capitania ya tiene asignado este rol.');
            return redirect()->back();
        }else {
            $capitaniaUser = $this->capitaniaUserRepository->find($id);

            if (empty($capitaniaUser)) {
                Flash::error('Capitania User not found');

                return redirect(route('capitaniaUsers.index'));
            }

            $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);

            Flash::success('Capitania User updated successfully.');

            return redirect(route('capitaniaUsers.index'));
        }

    }

    /**
     * Remove the specified CapitaniaUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Capitania User not found');

            return redirect(route('capitaniaUsers.index'));
        }

        $this->capitaniaUserRepository->delete($id);

        Flash::success('Capitania User deleted successfully.');

        return redirect(route('capitaniaUsers.index'));
    }
}
