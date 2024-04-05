<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {

        $shop = Shop::where('id', $uuid)->firstOrFail();

        return response()->json($shop);
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        Shop::create([
            'name' => $request->name,
            'theme' => $request->theme,
            'biography' => $request->biography,
            'user_id' => $request->user_id
        ]);

        return response()->json(['message' => 'Shop added successfully.']);
    }

//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Shop $shop)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
