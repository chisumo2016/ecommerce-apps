<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class DetachPermissionFromRoleController extends Controller
{
    public function __invoke(Request $request)
    {
        $permission = Permission::findById($request->permissionId);

        $permission->removeRole($request->roleId);

        return redirect()->back()->with('message', 'Permission detached successfully.');
    }
}