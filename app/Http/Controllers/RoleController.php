<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    function index() {
        $roleUser = Role::where('id', session()->get('role_id'))->first();
        $roles = Role::all();
        return view('dashboard.roles.index', [
            'roles' => $roles,
            'roleUser' => $roleUser
        ]);
    }

    function create(Request $request) {
        $role = new Role([
            'id' => Str::uuid(),
            'name' => $request->roleName
        ]);

        if ($role->save()) return response()->json([
            'status' => 201,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    function update($id, Request $request) {
        $role = Role::find($id);

        $role->name = $request->roleName;

        if ($role->save()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    function delete($id) {
        $role = Role::find($id);

        if ($role->delete()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }
}
