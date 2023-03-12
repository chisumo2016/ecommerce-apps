<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $roles = Role::select([
            'id',
            'name',
            'created_at'
        ])->latest()->paginate(10);

        //dd($roles);

        return Inertia::render('Admin/Roles/Index',[
            'roles' => RoleResource::collection($roles),

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
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
