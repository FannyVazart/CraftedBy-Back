<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {

        $prod = Product::where('id', $uuid)->firstOrFail();

        return response()->json($prod);
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//          //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
         Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'shop_id' => $request->shop_id
        ]);

        return response()->json(['message' => 'Product added successfully.']);
    }


//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Product $product)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $product = Product::where('id', $uuid)->firstOrFail();

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'shop_id' => $request->shop_id
        ]);

        return response()->json(['message' => 'Product updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $prod = Product::where('id', $uuid)->firstOrFail();

        if (!$prod) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $prod->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
