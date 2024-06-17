<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/products",
     *     summary="Get a list of products",
     *     tags={"products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
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
     * Display the specified resource if user is the right one.
     */
    public function showIfAllowed($user_id, $product_id)
    {
        $product = Product::where('id', $product_id)->firstOrFail();
        if ($product->user_id == $user_id) {
            return $product;
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
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
    public function update(UpdateProductRequest $request, $uuid)
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


    /* Custom methods */


    /**
     * Filters
     */
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
