<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zarpes\CreateCapitaniaUserRequest;
use App\Http\Requests\Zarpes\UpdateCapitaniaUserRequest;
use App\Repositories\Zarpes\CapitaniaUserRepository;
use Illuminate\Http\Request;

class CapitaniaUserController extends Controller
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

        return view('capitania_users.index')
            ->with('capitaniaUsers', $capitaniaUsers);
    }

    /**
     * Show the form for creating a new CapitaniaUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('capitania_users.create');
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
        $input = $request->all();

        $capitaniaUser = $this->capitaniaUserRepository->create($input);

        Flash::success('Capitania User saved successfully.');

        return redirect(route('capitaniaUsers.index'));
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

        return view('capitania_users.show')->with('capitaniaUser', $capitaniaUser);
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

        if (empty($capitaniaUser)) {
            Flash::error('Capitania User not found');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('capitania_users.edit')->with('capitaniaUser', $capitaniaUser);
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
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Capitania User not found');

            return redirect(route('capitaniaUsers.index'));
        }

        $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);

        Flash::success('Capitania User updated successfully.');

        return redirect(route('capitaniaUsers.index'));
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
