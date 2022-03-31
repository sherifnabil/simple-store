<?php

namespace App\Http\Controllers\API\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\API\OrderRequest;
use App\Notifications\NewOrderNotification;

class StoreController extends Controller
{
    public function __invoke(OrderRequest $request): JsonResponse
    {
        $order = Order::create($request->validated());

        $product = Product::find($request->product_id);
        $product->stock -= 1;
        $product->save();

        $order->client->notify(new NewOrderNotification($product));

        return new JsonResponse(
            data: new OrderResource($order->load(['client', 'product'])),
            status: Response::HTTP_OK,
        );
    }
}
