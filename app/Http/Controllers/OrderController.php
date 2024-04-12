<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
     * Display the specified resource if user is the right one.
     */
    public function showIfAllowed($user_id, $order_id)
    {
        $order = Order::where('id', $order_id)->firstOrFail();
        if ($order->user_id == $user_id) {
            return $order;
        }
        return response()->json(['message' => 'Unauthorized'], 401);
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

    public function saveOrder()
    {
        $order = new Order(['date' => date(now())]);

        $user = User::find(Auth::id());

        $user->orders()->save($order);
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

    /* Custom methods */

    /**
     * Calculate the total price of an order
     */

    /**
     * Add product to order
     */
    public function addProductToOrder($order_id, $product_id, $quantity)
    {
        $order = Order::where('id', $order_id)->firstOrFail();

        $order->products()->attach($product_id, ['quantity' => $quantity], ['price' => $product_id->price*$quantity]);

        return response()->json(['message' => 'Product added to order.'], 200);
    }

    /**
     * Remove product from order
     */
    public function removeProductFromOrder($order_id, $product_id)
    {
        $order = Order::where('id', $order_id)->firstOrFail();

        $order->products()->detach($product_id);

        return response()->json(['message' => 'Product removed from order.'], 200);
    }

    /**
     * Calculate the total price of an order
     */
    public function calculateTotalPrice($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $products = $order->products;
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price;
        }
        return $totalPrice;
    }


    /*
    * Filters
    */
    public function getOrdersByUser($id)
    {
        return Order::where('user_id', $id)->get();
    }
}
