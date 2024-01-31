<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    public function index() {
        $permissions = Permission::with('roles')->get();
        return view('pages.permission.index', compact('permissions'));
    }

    public function create() {
        return view('pages.permission.create');
    }

    public function store(Request $request) {

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard
        ]);

        toast()->success('Berhasil menambahkan hak akses', 'Berhasil');
        return redirect()->route('admin.permission.index');
    }
}
