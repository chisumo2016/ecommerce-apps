<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolesRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private  $routeResourceName  = 'roles';

    public  function  __construct()
    {
        $this->middleware('can:view roles list')->only('index');
        $this->middleware('can:create role')->only(['create', 'store']);
        $this->middleware('can:edit role')->only(['edit', 'update']);
        $this->middleware('can:delete role')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $roles = Role::query()
            ->select([
                'id',
                'name',
                'created_at'
            ])
            ->when($request->name, fn(Builder $builder, $name) => $builder->where('name', 'like',"%{$name}%"))
            ->latest()
            ->paginate(10);

        //dd($roles);

        return Inertia::render('Admin/Roles/Index',[
            'title' => 'Roles',
            'items' => RoleResource::collection($roles),
            ///'roles' => RoleResource::collection($roles),

            'headers' => [
                [
                    'label' => 'Name' ,
                    'name'  => 'name'
                ],
                [
                    'label' => 'Created At' ,
                    'name'  => 'created_at'
                ],
                [
                    'label' => 'Actions' ,
                    'name'  => 'actions'
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create role')
            ]

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('Admin/Roles/Create',[
           'edit' => false,
           'title' => 'Add  Role'
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {

        $role = Role::create($request->validated());

        return redirect()->route('roles.edit',$role)->with('message','Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role->load(['permissions:permissions.id,permissions.name']);


        return Inertia::render('Admin/Roles/Create',[
            'edit' => true,
            'title' => 'Edit Role',
            'item' => new RoleResource($role),
            'routeResourceName' => $this->routeResourceName,
            'permissions' => PermissionResource::collection(Permission::get(['id' , 'name'])),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('roles.index')->with('message','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message','Role deleted successfully');
    }
}
