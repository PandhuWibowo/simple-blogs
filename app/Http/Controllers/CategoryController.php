<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', [
            'categories' => $categories
        ]);
    }
    
    public function create(Request $request)
    {
        $category = new Category([
            'id' => Str::uuid(),
            'name' => $request->name
        ]);

        if ($category->save()) return response()->json([
            'status' => 201,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    function update($id, Request $request) {
        $category = Category::find($id);

        $category->name = $request->name;

        if ($category->save()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }

    function delete($id) {
        $category = Category::find($id);

        if ($category->delete()) return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);

        return response()->json([
            'status' => 400,
            'message' => 'Failed'
        ]);
    }
}
