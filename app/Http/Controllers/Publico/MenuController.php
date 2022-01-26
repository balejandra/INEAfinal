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

        $this->middleware('permission:listar-menu', ['only'=>['index'] ]);
        $this->middleware('permission:crear-menu', ['only'=>['create','store']]);
        $this->middleware('permission:editar-menu', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-menu', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-menu', ['only'=>['destroy'] ]);
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
       // $roles=Role::pluck('name','id');

        $parents= Menu::where('enabled',1)->orderBy('id')->get();
        $noparent=['0' => 'Menu Padre'];
        $parents2=$parents->pluck('name','id','description')->toArray();
        $parent=$noparent+$parents2;

        $menuRols = Role::selectRaw(" roles.*, '' as checked")->get();

        return view('publico.menus.create')
            ->with('roles',$menuRols)
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

        $menu= Menu::create($request->except(['role']));
        $roles = $menu->roles()->sync($request['role']);
 

        //$input = $request->all();
       // var_dump($request->except(['role']));
        /*$menu = $this->menuRepository->create($input);
        $roles = Menu_rol::create([
            'menu_id' => $menu['id'],
            'role_id' =>$request['role']
        ]);*/


       // Flash::success('Menú guardado con éxito.');
        return redirect()->route('menus.index')->with('success','Menú actualizado correctamente.'); 
        //return redirect(route('menus.index'));
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
            return redirect()->route('menus.index')->with('error','Menu no encontrado'); 

            //return redirect(route('menus.index'));
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

       // $roles=Role::pluck('name','id');

        $parents= Menu::where('enabled',1)->orderBy('id')->get();
        $noparent=['0' => 'Menu Padre'];
        $parents2=$parents->pluck('name','id')->toArray();
        $parent=$noparent+$parents2;

        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            //Flash::error('Menú no encontrado');

            return redirect()->route('menus.index')->with('error','Menu no encontrado'); 
        }

        $menuRols = Role::selectRaw(" roles.name as name, roles.id as id,menus_roles.menu_id, menus_roles.role_id,(CASE WHEN menus_roles.role_id = roles.id THEN 'checked' ELSE '' END) AS
        checked")
            ->leftJoin('menus_roles', function ($join) use ($id) {
                $join->on('roles.id', '=', 'menus_roles.role_id')
                    ->where('menus_roles.menu_id', '=', $id);
            })
            ->get();

        return view('publico.menus.edit')
            ->with('menu', $menu)
           // ->with('roles',$roles)
            ->with('parent',$parent)
            ->with('roles',$menuRols);
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
            //Flash::error('Menú no encontrado');

            return redirect()->route('menus.index')->with('error','Menu no encontrado'); 
        }
        //var_dump($request['role']);
        $menu = $this->menuRepository->update($request->all(), $id);
        $role=new Menu();
        $roles1=$request['role'];
        $roles = $menu->roles()->sync($request['role']);

       // Flash::success('Menú actualizado correctamente.');
        return redirect()->route('menus.index')->with('success','Menú actualizado correctamente.'); 

       // return redirect(route('menus.index'));
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
            //Flash::error('Menú no encontrado');

            return redirect()->route('menus.index')->with('error','Menu no encontrado'); 

        }

        $this->menuRepository->delete($id);
        $parents= Menu_rol::where('menu_id',$id)->delete();

        //Flash::success('Menú eliminado con éxito.');

        return redirect()->route('menus.index')->with('success','Menu eliminado con exito.'); 
    }
}
