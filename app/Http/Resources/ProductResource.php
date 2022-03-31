<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'product',
            'attributes'  =>  [
                'title' =>  $this->title,
                'price' =>  $this->price,
                'active'=>  $this->active,
                'stock' =>  $this->stock,
            ],
            'relations'    =>  [
                'categories' =>  CategoryResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'categories'
                    )
                )
            ],
        ];
    }
}
