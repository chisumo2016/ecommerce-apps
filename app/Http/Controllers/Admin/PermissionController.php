<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionsRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private  $routeResourceName  = 'permissions';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ): Response
    {
        $permissions = Permission::query()
            ->select([
                'id',
                'name',
                'created_at'
            ])
            ->when($request->name, fn(Builder $builder, $name) => $builder->where('name', 'like',"%{$name}%"))
            ->latest()
            ->paginate(10);

        //dd($permission);

        return Inertia::render('Admin/Permissions/Index',[
            'title' => 'permission',
            'items' => PermissionResource::collection($permissions),
            ///'permission' => RoleResource::collection($permission),

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
                'create' => $request->user()->can('create permission')
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create',[
            'edit' => false,
            'title' => 'Add  Permission',
            'routeResourceName' => $this->routeResourceName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionsRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('permissions.index')->with('message','Permission created successfully');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permissions/Create',[
            'edit' => true,
            'title' => 'Edit Permission',
            'item' => new PermissionResource($permission),
            'routeResourceName' => $this->routeResourceName
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionsRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return redirect()->route('permissions.index')->with('message','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message','Role deleted successfully');
    }
}
