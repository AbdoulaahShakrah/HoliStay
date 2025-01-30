<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
        return [
            'property_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date'],
            'reservation_amount' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'property_id' => $this->propertyId,
            'client_id' => $this->clientId,
            'check_in_date' => $this->checkInDate,
            'check_out_date' => $this->checkOutDate,
            'reservation_amount' => $this->reservationAmount,
        ]);
    }
}
