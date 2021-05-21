<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index() {
        $roles = Role::all();
        $users = User::with('role')->get();
        return view('dashboard.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function store(Request $request) {
        $user = new User([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id
        ]);
        if ($user->save()) return response()->json([
            'status' => 201,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    function delete($id) {
        $user = User::find($id);

        if ($user->delete()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    function update ($id, Request $request) {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($user->save()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }
}
