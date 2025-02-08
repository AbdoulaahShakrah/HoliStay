<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && ($user->tokenCan('restricted') || $user->tokenCan('total'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'property_name' => ['required', 'string', 'max:255'],
                'property_country' => ['required', 'string', 'max:255'],
                'property_city' => ['required', 'string', 'max:255'],
                'property_address' => ['required', 'string', 'max:255'],
                'property_type' => ['required', 'string', 'max:255'],
                'property_bedrooms' => ['nullable', 'integer', 'min:0'],
                'property_bathrooms' => ['nullable', 'integer', 'min:0'],
                'property_beds' => ['nullable', 'integer', 'min:0'],
                'cancellation_policy' => ['required', 'integer', 'min:0'],
                'property_price' => ['required', 'numeric', 'min:0'],
                'property_status' => ['required', 'string', Rule::in(['Available', 'Occupied'])],
                'property_capacity' => ['required', 'integer', 'min:1'],
                'property_description' => ['required', 'string'],
                
                'amenities' => ['required', 'array'],
                'amenities.*' => ['integer', 'exists:amenities,amenity_id'],
                //'photos' => ['required', 'array'],
                //'photos.*' => ['string'],
                
            ];
        } else {
            return [
                'property_name' => ['sometimes', 'required', 'string', 'max:255'],
                'property_country' => ['sometimes', 'required', 'string', 'max:255'],
                'property_city' => ['sometimes', 'required', 'string', 'max:255'],
                'property_address' => ['sometimes', 'required', 'string', 'max:255'],
                'property_type' => ['sometimes', 'required', 'string', 'max:255'],
                'property_bedrooms' => ['sometimes', 'nullable', 'integer', 'min:0'],
                'property_bathrooms' => ['sometimes', 'nullable', 'integer', 'min:0'],
                'page_visits' => ['sometimes', 'required', 'integer', 'min:0'],
                'property_beds' => ['sometimes', 'nullable', 'integer', 'min:0'],
                'cancellation_policy' => ['sometimes', 'required', 'integer', 'min:0'],
                'property_price' => ['sometimes', 'required', 'numeric', 'min:0'],
                'property_status' => ['sometimes', 'required', 'string', Rule::in(['Available', 'Occupied'])],
                'property_capacity' => ['sometimes', 'required', 'integer', 'min:1'],
                'property_description' => ['sometimes', 'required', 'string']
            ];
        }
    }
    protected function prepareForValidation()
    {
        $data = [];
        if ($this->has('hostId')) {
            $data['host_id'] = $this->hostId;
        }
        if ($this->has('propertyName')) {
            $data['property_name'] = $this->propertyName;
        }
        if ($this->has('propertyCountry')) {
            $data['property_country'] = $this->propertyCountry;
        }
        if ($this->has('propertyCity')) {
            $data['property_city'] = $this->propertyCity;
        }
        if ($this->has('propertyAddress')) {
            $data['property_address'] = $this->propertyAddress;
        }
        if ($this->has('propertyType')) {
            $data['property_type'] = $this->propertyType;
        }
        if ($this->has('propertyBedrooms')) {
            $data['property_bedrooms'] = $this->propertyBedrooms;
        }
        if ($this->has('propertyBathrooms')) {
            $data['property_bathrooms'] = $this->propertyBathrooms;
        }
        if ($this->has('propertyBeds')) {
            $data['property_beds'] = $this->propertyBeds;
        }
        if ($this->has('cancellationPolicy')) {
            $data['cancellation_policy'] = $this->cancellationPolicy;
        }
        if ($this->has('propertyPrice')) {
            $data['property_price'] = $this->propertyPrice;
        }
        if ($this->has('propertyStatus')) {
            $data['property_status'] = $this->propertyStatus;
        }
        if ($this->has('propertyCapacity')) {
            $data['property_capacity'] = $this->propertyCapacity;
        }
        if ($this->has('propertyDescription')) {
            $data['property_description'] = $this->propertyDescription;
        }
        if($this->has('pageVisits')){
            $data['page_visits'] = $this->pageVisits;
        }
        
        $this->merge($data);
    }
}
