<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($property) {
            return [
                'property_id' => $property->property_id,
                'property_name' => $property->property_name,
                'host' => new HostResource($property->whenLoaded('host')),
                'property_country' => $property->property_country,
                'property_city' => $property->property_city,
                'property_type' => $property->property_type,
                'property_price' => $property->property_price,
                'property_status' => $property->property_status,
                'property_capacity' => $property->property_capacity,
                'page_visits' => $property->page_visits,
                'photos' => new PhotoCollection($property->whenLoaded('photos')),
                'amenities' => new PropertyAmenitiesCollection($property->whenLoaded('property_amenities')),
                'taxes' => new PropertyTaxesCollection($property->whenLoaded('property_taxes')),
            ];
        })->toArray();
    }
}
