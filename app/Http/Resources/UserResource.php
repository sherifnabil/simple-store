<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'user',
            'attributes'    =>  [
                'email' =>  $this->email,
                'name' =>  $this->name,
            ],
            'token' =>  $this->response['token'],
        ];
    }
}
