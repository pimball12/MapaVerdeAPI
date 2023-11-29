<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GardenStoreRequest extends FormRequest
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

            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'name'          => 'required|string|max:255',
            'description'   => 'required|string',
            'contact_phone' => 'required|string|max:255',
            'contact_email' => 'required|string|max:255',
            'opening_time'  => 'required|date',
            'closing_time'  => 'required|date',
            'running'       => 'required'
        ];
    }
}
