<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Polyfill\Uuid\Uuid;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get a list of products",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"Products"},
     *     summary="Find product by ID",
     *     description="Returns a single product",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of product to return",
     *         required=true,
     *         @OA\Schema(
     *             type="uuid",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplier"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pet not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */
    public function show($uuid)
    {
        return Product::where('id', $uuid)->firstOrFail();
    }


    public function showIfAllowed($user_id, $product_id)
    {
        $product = Product::where('id', $product_id)->firstOrFail();
        if ($product->user_id == $user_id) {
            return $product;
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Add a new product.
     *
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     operationId="addProduct",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"petstore_auth": {"write:pets", "read:pets"}}
     *     }
     * )
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

    /**
     * @OA\Get(
     *     path="/api/products/shop/{id]",
     *     summary="Get all the products from 1 shop",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByShop($shop_id)
    {
        return Product::where('shop_id', $shop_id)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{category]",
     *     summary="Get all the products from 1 category",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByCategory($category_id)
    {
        return Product::where('category_id', $category_id)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{price}",
     *     summary="Get all the products of a price",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByPrice($price)
    {
        return Product::where('price', $price)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{color}",
     *     summary="Get all the products of a color",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByColor($color)
    {
        return Product::where('color', $color)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{material}",
     *     summary="Get all the products of a material",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByMaterial($material)
    {
        return Product::where('material', $material)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{size}",
     *     summary="Get all the products of a size",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsBySize($size)
    {
        return Product::where('size', $size)->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{name}",
     *     summary="Get all the products of a name",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getProductsByName($name)
    {
        return Product::where('name', $name)->get();
    }



}
