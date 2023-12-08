<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories)->setStatusCode(200, 'OK');
    }

    public function create(CategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function update(CategoryRequest $request, string $id): JsonResponse
    {
        $category = Category::where('id', '=', $id)->first();

        if (!isset($category)) {
            return response()->json()->setStatusCode(404, 'Not Found');
        }

        $category->name = $request->name;

        $category->save();

        return response()->json($category)->setStatusCode(200, 'OK');
    }

    public function delete(string $id): JsonResponse
    {
        $category = Category::where('id', '=', $id)->delete();
        return response()->json($category)->setStatusCode(200, 'OK');
    }

    public function view(string $id)
    {
        return Category::where('id', '=', $id)->first();
    }
}
