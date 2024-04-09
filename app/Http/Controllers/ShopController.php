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
        return Shop::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        return Shop::where('id', $uuid)->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        return Shop::create([
            'name' => $request->name,
            'theme' => $request->theme,
            'biography' => $request->biography,
            'user_id' => $request->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, $uuid)
    {
        $shop = Shop::where('id', $uuid)->firstOrFail();

        return $shop->update([
            'name' => $request->name,
            'theme' => $request->theme,
            'biography' => $request->biography,
            'user_id' => $request->user_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $shop = Shop::where('id', $uuid)->firstOrFail();

        if (!$shop) {
            return response()->json(['message' => 'Shop not found.'], 404);
        }

        return $shop->delete();
    }
}
