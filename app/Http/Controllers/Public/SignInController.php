<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    function index () {
        return view('public.signin');
    }

    function authProcess(Request $request) {
        return $request->all();
    }
}
