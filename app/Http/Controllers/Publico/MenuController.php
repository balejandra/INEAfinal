<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\CreateMenuRequest;
use App\Http\Requests\Publico\UpdateMenuRequest;
use App\Models\Publico\Menu;
use App\Models\Publico\Menu_rol;
use App\Repositories\Publico\MenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;

class MenuController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $menus = $this->menuRepository->all();

        return view('publico.menus.index')
            ->with('menus', $menus);
    }


    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id');

        $parents= Menu::where('enabled',1)->orderBy('id')->get();
        $noparent=['0' => 'Menu Padre'];
        $parents2=$parents->pluck('name','id','description')->toArray();
        $parent=$noparent+$parents2;

        return view('publico.menus.create')
            ->with('roles',$roles)
            ->with('parent',$parent);
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateMenuRequest $request)
    {
        $input = $request->all();

        $menu = $this->menuRepository->create($input);
        $roles = Menu_rol::create([
            'menu_id' => $menu['id'],
            'role_id' =>$request['roles']
        ]);


        Flash::success('Menu saved successfully.');

        return redirect(route('menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        return view('publico.menus.show')->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $roles=Role::pluck('name','id');

        $parents= Menu::where('enabled',1)->orderBy('id')->get();
        $noparent=['0' => 'Menu Padre'];
        $parents2=$parents->pluck('name','id')->toArray();
        $parent=$noparent+$parents2;

        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        return view('publico.menus.edit')
            ->with('menu', $menu)
            ->with('roles',$roles)
            ->with('parent',$parent);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int $id
     * @param UpdateMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        $menu = $this->menuRepository->update($request->all(), $id);
        $role=new Menu();
        $roles1=$request['roles'];
        $roles = $role->roles()->sync([$roles1,$id]);

        Flash::success('Menu updated successfully.');

        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        $this->menuRepository->delete($id);
        $parents= Menu_rol::where('menu_id',$id)->delete();

        Flash::success('Menu deleted successfully.');

        return redirect(route('menus.index'));
    }
}
