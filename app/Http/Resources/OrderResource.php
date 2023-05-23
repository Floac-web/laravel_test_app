<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'api' => $this->api,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'orderPay' => new OrderPayResource($this['orderPay']),
            'orderProducts' => OrderProductResource::collection($this->orderProducts)
        ];
    }
}
