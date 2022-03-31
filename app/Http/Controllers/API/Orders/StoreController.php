<?php

namespace App\Http\Controllers\API\Orders;

use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\API\OrderRequest;
use App\Models\Product;

class StoreController extends Controller
{
    public function __invoke(OrderRequest $request): JsonResponse
    {
        $order = Order::create($request->validated());

        $product = Product::find($request->product_id);
        $product->stock -= 1;
        $product->save();

        return new JsonResponse(
            data: new OrderResource($order->load(['client', 'product'])),
            status: Response::HTTP_OK,
        );
    }
}
