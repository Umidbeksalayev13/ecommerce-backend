<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        auth()->user()->orders;
    }

    public function store(StoreOrderRequest $request)
    {
        $sum = 0;
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);

        if (!$address) {
            return response([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        // 1. Mahsulotlarni tekshirish
        foreach ($request['products'] as $requestProduct) {
            $product = Product::find($requestProduct['product_id']);

            if (!$product) {
                $requestProduct['error'] = 'Product not found';
                $notFoundProducts[] = $requestProduct;
                continue;
            }

            $stock = $product->stocks()->find($requestProduct['stock_id']);

            if (!$stock || $stock->quantity < $requestProduct['quantity']) {
                $requestProduct['we_have'] = $stock ? $stock->quantity : 0;
                $notFoundProducts[] = $requestProduct;
                continue;
            }

            $sum += $stock->price * $requestProduct['quantity'];
        }

        // 2. Agar barcha mahsulotlar to‘g‘ri bo‘lsa
        if (empty($notFoundProducts)) {
            $order = auth()->user()->orders()->create([
                'comment' => $request->comment,
                'delivery_method_id' => $request->delivery_method_id,
                'payment_type_id' => $request->payment_type_id,
                'address_id' => $address->id,
                'sum' => $sum,
            ]);

            // 3. attach() orqali products va pivot ma’lumotlarini bog‘lash
            foreach ($request['products'] as $requestProduct) {
                $order->products()->attach($requestProduct['product_id'], [
                    'stock_id' => $requestProduct['stock_id'],
                    'quantity' => $requestProduct['quantity'],
                ]);

                // 4. Ombordagi mahsulot miqdorini kamaytirish
                $stock = Stock::find($requestProduct['stock_id']);
                $stock->quantity -= $requestProduct['quantity'];
                $stock->save();
            }

            return response([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
            ]);
        }

        // 5. Xatolik bo‘lsa
        return response([
            'success' => false,
            'message' => 'Some products are not available in requested quantity',
            'not_found_products' => $notFoundProducts,
        ]);
    }




    public function show(Order $order)
    {
        return new OrderResource($order);
    }


    public function edit(Order $order)
    {
        //
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
