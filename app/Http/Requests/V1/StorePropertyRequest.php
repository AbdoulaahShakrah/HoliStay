<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'host_id' => ['required', 'integer'],
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
            'property_description' => ['required', 'string']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'host_id' => $this->hostId,
            'property_name' => $this->propertyName,
            'property_country' => $this->propertyCountry,
            'property_city' => $this->propertyCity,
            'property_address' => $this->propertyAddress,
            'property_type' => $this->propertyType,
            'property_bedrooms' => $this->propertyBedrooms,
            'property_bathrooms' => $this->propertyBathrooms,
            'property_beds' => $this->propertyBeds,
            'cancellation_policy' => $this->cancellationPolicy,
            'property_price' => $this->propertyPrice,
            'property_status' => $this->propertyStatus,
            'property_capacity' => $this->propertyCapacity,
            'property_description' => $this->propertyDescription,
        ]);
    }
}
