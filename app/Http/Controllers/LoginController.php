<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signIn () {
        return view('public.signin');
    }

    public function authProcess(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $userInfo = User::where('email', $request->email)->first();
        if (!$userInfo || empty($userInfo)) return back()->with('failed', 'Kamu belum terdaftar');
        else {
            if (Hash::check($request->password, $userInfo->password)) {
                session()->put('id', $userInfo->id);
                session()->put('name', $userInfo->name);
                session()->put('email', $userInfo->email);
                session()->put('role_id', $userInfo->role_id);
                return redirect()->intended('roles');
            } else return back()->with('failed', 'Password salah');
        }
    }

    public function signout()  {
        if (session()->has('id')) {
            session()->pull('id');
            session()->pull('name');
            session()->pull('email');
            session()->pull('role_id');
        }

        return redirect('signin');
    }
}
