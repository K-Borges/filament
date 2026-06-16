<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->get();

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $ids = collect($request->items)->pluck('product_id');
        $products = Product::whereIn('id', $ids)->get()->keyBy('id');

        $total = 0;
        $items = [];

        foreach ($request->items as $item) {
            $product = $products[$item['product_id']];
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        $order = DB::transaction(function () use ($request, $total, $items) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $total,
                'status' => 'Pendente',
            ]);

            $order->items()->createMany($items);

            return $order;
        });

        $order->load('items.product');

        return new OrderResource($order);
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $order->load('items.product');

        return new OrderResource($order);
    }
}
