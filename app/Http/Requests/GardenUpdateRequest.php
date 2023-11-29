<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GardenUpdateRequest extends FormRequest
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

            'lat'           => 'sometimes|required|numeric',
            'lng'           => 'sometimes|required|numeric',
            'name'          => 'sometimes|required|string|max:255',
            'description'   => 'sometimes|required|string',
            'contact_phone' => 'sometimes|required|string|max:255',
            'contact_email' => 'sometimes|required|string|max:255',
            'opening_time'  => 'sometimes|required|date',
            'closing_time'  => 'sometimes|required|date',
            'running'       => 'sometimes|required'
        ];
    }
}
