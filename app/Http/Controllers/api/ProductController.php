<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginatedProducts = Product::with('category')->paginate(15);
        return ProductResource::collection($paginatedProducts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json($product, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $productId)
    {
        $product = Product::findOrFail($productId);
        return response()->json($product, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $productId): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $validationRules = [
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'category_id' => 'exists:categories,id'
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->only(array_keys($validationRules)));

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $productId)
    {
        $product = Product::findOrFail($productId);

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
