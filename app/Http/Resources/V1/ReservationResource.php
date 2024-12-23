<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reservation_id' => $this->reservation_id,
            'client_id' => $this->client_id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'reservation_status' => $this->reservation_status,
            'reservation_amount' => $this->reservation_amount,
            'property' => new PropertyResource($this->whenLoaded('property')),
           
        ];
    }
}
