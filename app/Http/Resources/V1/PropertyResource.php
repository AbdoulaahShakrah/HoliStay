<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'property_id' => $this->property_id,
            'host_id' => $this->host_id,
            'property_name' => $this->property_name,
            'property_country' => $this->property_country,
            'property_city' => $this->property_city,
            'property_type' => $this->property_type,
            'property_address' => $this->property_address,
            'property_bedrooms' => $this->property_bedrooms,
            'property_bathrooms' => $this->property_bathrooms,
            'property_beds' => $this->property_beds,
            'cancellation_policy' => $this->cancellation_policy,
            'property_price' => $this->property_price,
            'property_status' => $this->property_status,
            
            'property_capacity' => $this->property_capacity,
            'property_description' => $this->property_description,
            'page_visits' => $this->page_visits,
            'photos' => new PhotoCollection($this->whenLoaded('photos')),
            'amenities' => new PropertyAmenitiesCollection($this->whenLoaded('property_amenities')),
            'taxes' => new PropertyTaxesCollection($this->whenLoaded('property_taxes')),
        ];
    }
}
