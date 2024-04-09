<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        return Order::where('id', $uuid)->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        return Order::create([
            'date' => $request->date,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $uuid)
    {
        $product = Order::where('id', $uuid)->firstOrFail();

        return $product->update([
            'date' => $request->date,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $order = Order::where('id', $uuid)->firstOrFail();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        return $order->delete();
    }
}
