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
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {

        $order = Order::where('id', $uuid)->firstOrFail();

        return response()->json($order);
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
        Order::create([
            'date' => $request->date,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Order added successfully.']);
    }


//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Order $order)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $product = Order::where('id', $uuid)->firstOrFail();

        $product->update([
            'date' => $request->date,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Order updated successfully.']);
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

        $order->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
