<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    function index() {
        $categories = Category::all();
        $users = User::all();
        $posts = Post::with('category')->with('user')->get();
        return view('dashboard.posts.index', [
            'categories' => $categories,
            'users' => $users,
            'posts' => $posts
        ]);
    }

    function store(Request $request) {

    }

    function update($id, Request $request) {

    }

    function delete($id) {

    }
}
