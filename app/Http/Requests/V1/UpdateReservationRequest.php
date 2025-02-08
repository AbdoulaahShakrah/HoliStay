<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
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
            'reservation_status' => ['required', Rule::in(['Cancelled', 'Confirmed', 'Pending'])]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'reservation_status' => $this->reservationStatus]);            
    }
}
