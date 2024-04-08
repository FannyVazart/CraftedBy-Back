<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        return Product::where('id', $uuid)->firstOrFail();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
         return Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'shop_id' => $request->shop_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $product = Product::where('id', $uuid)->firstOrFail();

        return $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'shop_id' => $request->shop_id
        ]);
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

        return $prod->delete();
    }

    public function getProductsByShop($shop_id)
    {
        return Product::where('shop_id', $shop_id)->get();
    }

    public function getProductsByCategory($category_id)
    {
        return Product::where('category_id', $category_id)->get();
    }

    public function getProductsByPrice($price)
    {
        return Product::where('price', $price)->get();
    }

    public function getProductsByColor($color)
    {
        return Product::where('color', $color)->get();
    }

    public function getProductsByMaterial($material)
    {
        return Product::where('material', $material)->get();
    }

    public function getProductsBySize($size)
    {
        return Product::where('size', $size)->get();
    }

    public function getProductsByName($name)
    {
        return Product::where('name', $name)->get();
    }



}
