<?php

namespace App\Http\Controllers\API\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryProductsResource;

class CategoryProductsController extends Controller
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $category = Category::where('id', $id)
        ->with(['products' => function ($product) {
            $product
            ->active()
            ->where('stock', '>', 0);
        }
        ])
        ->first();

        return new JsonResponse(
            data: new CategoryProductsResource($category),
            status: Response::HTTP_OK,
        );
    }
}
