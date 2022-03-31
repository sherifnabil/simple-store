<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'order',
            'relations'    =>  [
                'client' =>  new UserResource(
                    resource: $this->whenLoaded(
                        relationship: 'client'
                    )
                ),
                'product' =>  new ProductResource(
                    resource: $this->whenLoaded(
                        relationship: 'product'
                    )
                )
            ],
        ];
    }
}
