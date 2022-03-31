<?php

namespace App\Http\Controllers\API\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('categories')
        ->active()
        ->where('stock', '>', 0)
        ->get();

        return new JsonResponse(
            data: ProductResource::collection($products),
            status: Response::HTTP_OK,
        );
    }
}
