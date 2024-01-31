<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionController extends Controller
{
    public function index() {
        $roles = Role::with('permissions')->get();
        return  view('pages.role.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('pages.permission-assign.create', compact('permissions', 'roles'));
    }

    public function store(Request $request) {

        $role = Role::where('name', $request->role)->firstOrFail();
        $role->syncPermissions(json_decode($request->permissions));

        toast()->success('Berhasil menambahkan hak akses ke role', 'Berhasil');
        return redirect()->route('admin.assign.index');
    }

    public function show($role) {
        $role = Role::where('id', $role)->with('permissions')->first();

        $allPermissions = Permission::all();
        $permissionDoesNotHaveRole = $allPermissions->diff($role->permissions);

        return view('pages.permission-assign.show', compact('role', 'permissionDoesNotHaveRole'));
    }


}
