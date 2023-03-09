<?php

namespace App\Http\Controllers\Publico;
use App\Http\Controllers\Controller;
use App\Models\Publico\PermissionOwn;
use App\Models\Publico\RoleOwn;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Flash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {

        $this->middleware('permission:listar-rol', ['only'=>['index'] ]);
        $this->middleware('permission:crear-rol', ['only'=>['create','store']]);
        $this->middleware('permission:editar-rol', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-rol', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-rol', ['only'=>['destroy'] ]);

    }

   public function index()
    {
        $roles= RoleOwn::all();
        return view('publico.roles.index', compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions=PermissionOwn::all()->pluck('name','id');
        //dd($permissions);
        return view('publico.roles.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions'=>'required'
        ],
            [
                'name.unique'=>'Rol ya registrado',
                'permissions.required'=>'Es obligatorio asignar permisos al Rol'

            ]
    );

        $role= RoleOwn::create($request->only('name'));
        $role->permissions()->sync($request->input('permissions', [] ));
        return redirect()->route('roles')->with('success','Rol creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role=RoleOwn::find($id);
        return view('publico.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RoleOwn $role
     * @return Response
     */
    public function edit(RoleOwn $role)
    {
        $permissions=PermissionOwn::all()->pluck('name','id');
        $role->load('permissions');
        //dd($role);
        return view('publico.roles.edit',compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  RoleOwn $role
     * @return Response
     */
    public function update(Request $request, RoleOwn $role)
    {

        $validated = $request->validate([
            'name' =>  ['required', 'max:255', Rule::unique('roles')->ignore($role['id'])],
            'permissions'=>'required'
        ],
            [
                'name.unique'=>'Rol ya registrado',
                'permissions.required'=>'Es obligatorio asignar permisos al Rol'

            ]
        );

        $role->update($request->only('name'));
        $role->permissions()->sync($request->input('permissions', [] ));

       /*$role=Role::findOrFail($id);
        $role->name=$request->input('name');
        $role->save();*/
        return redirect()->route('roles')->with('success','Información actualizada con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role=RoleOwn::findOrFail($id);
        $role->delete();
        return back()->with('success','El registro se ha eliminado con éxito.');
    }

    public function indexRoleDeleted(){
        $role =RoleOwn::onlyTrashed()->get();
        //dd($users);

        return view('publico.roles.rolesDeleted')
            ->with('roles', $role);
    }

    public function restoreRoleDeleted($id){
        $role_deleted=RoleOwn::where('id',$id);
        $role_deleted->restore();
        Flash::success('Rol restaurado exitosamente.');

        return redirect(route('roleDelete.index'));
    }
}
