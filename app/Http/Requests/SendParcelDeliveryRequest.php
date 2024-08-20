<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SendParcelDeliveryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'operator' => 'required',
        ];
    }

    public function authorize(): bool
    {
        // Let's make it like this for testing purpose.
        return true;
    }
}
