<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->currency) {
            return [
                'currency' => $this->currency,
                'amount' => $this->amount,
                'status' => $this->status,
                'system' => $this->system
            ];
        }

        return ['url' => $this];
    }
}
