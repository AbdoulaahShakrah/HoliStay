<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
            'reservation_id' => ['required', 'integer'],
            'payment_method' => ['required', 'string', Rule::in(["Paypall", "Credit Card"])],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'reservation_id' => $this->reservationId,
            'payment_method' => $this->paymentMethod,
        ]);
    }
}
