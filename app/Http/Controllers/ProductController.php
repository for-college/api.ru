<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products)->setStatusCode(200, 'OK');
    }

    public function create(ProductRequest $request)
    {
        return Product::create($request->all());
    }

    public function update(ProductRequest $request, string $id): JsonResponse
    {
        $product = Product::where('id', '=', $id)->first();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->photo = $request->photo;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

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
