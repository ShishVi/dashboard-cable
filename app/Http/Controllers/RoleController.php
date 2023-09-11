<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.list-roles',[
            'roles' => Role::all()->sortBy('name'),
        ]);
    }

    public function create()
    {
        return view('admin.role.create-roles');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:25|unique:roles'
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('list.roles');
    }

    public function delete($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        return back();
    }
}
