<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products)->setStatusCode(200, 'OK');
    }

    public function create(Request $request)
    {
        return Product::create($request->all());
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::where('id', '=', $id)->first();

        if (isset($request->name) &&
            isset($request->price) &&
            isset($request->quantity) &&
            isset($request->photo) &&
            isset($request->description) &&
            isset($request->category_id)
        ) {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->photo = $request->photo;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
        } else {
            return response()->json('Invalid data')->setStatusCode(400, 'Bad Request');
        }

        $product->save();

        return response()->json($product)->setStatusCode(200, 'OK');
    }

    public function delete(string $id): JsonResponse
    {
        $product = Product::where('id', '=', $id)->delete();
        return response()->json($product)->setStatusCode(200, 'OK');
    }

    public function view(string $id)
    {
        return Product::where('id', '=', $id)->first();
    }
}
