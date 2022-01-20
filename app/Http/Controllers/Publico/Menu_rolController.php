<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\CreateMenu_rolRequest;
use App\Http\Requests\Publico\UpdateMenu_rolRequest;
use App\Repositories\Publico\Menu_rolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Menu_rolController extends AppBaseController
{
    /** @var  Menu_rolRepository */
    private $menuRolRepository;

    public function __construct(Menu_rolRepository $menuRolRepo)
    {
        $this->menuRolRepository = $menuRolRepo;
    }

    /**
     * Display a listing of the Menu_rol.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $menuRols = $this->menuRolRepository->all();

        return view('publico.menus.tableroles')
            ->with('menuRols', $menuRols);
    }

    /**
     * Show the form for creating a new Menu_rol.
     *
     * @return Response
     */
    public function create()
    {
        return view('menu_rols.create');
    }

    /**
     * Store a newly created Menu_rol in storage.
     *
     * @param CreateMenu_rolRequest $request
     *
     * @return Response
     */
    public function store(CreateMenu_rolRequest $request)
    {
        $input = $request->all();

        $menuRol = $this->menuRolRepository->create($input);

        Flash::success('Menu Rol saved successfully.');

        return redirect(route('menuRols.index'));
    }

    /**
     * Display the specified Menu_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $menuRol = $this->menuRolRepository->find($id);

        if (empty($menuRol)) {
            Flash::error('Menu Rol not found');

            return redirect(route('menuRols.index'));
        }

        return view('menu_rols.show')->with('menuRol', $menuRol);
    }

    /**
     * Show the form for editing the specified Menu_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menuRol = $this->menuRolRepository->find($id);

        if (empty($menuRol)) {
            Flash::error('Menu Rol not found');

            return redirect(route('menuRols.index'));
        }

        return view('menu_rols.edit')->with('menuRol', $menuRol);
    }

    /**
     * Update the specified Menu_rol in storage.
     *
     * @param int $id
     * @param UpdateMenu_rolRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenu_rolRequest $request)
    {
        $menuRol = $this->menuRolRepository->find($id);

        if (empty($menuRol)) {
            Flash::error('Menu Rol not found');

            return redirect(route('menuRols.index'));
        }

        $menuRol = $this->menuRolRepository->update($request->all(), $id);

        Flash::success('Menu Rol updated successfully.');

        return redirect(route('menuRols.index'));
    }

    /**
     * Remove the specified Menu_rol from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menuRol = $this->menuRolRepository->find($id);

        if (empty($menuRol)) {
            Flash::error('Menu Rol not found');

            return redirect(route('menuRols.index'));
        }

        $this->menuRolRepository->delete($id);

        Flash::success('Menu Rol deleted successfully.');

        return redirect(route('menuRols.index'));
    }
}
