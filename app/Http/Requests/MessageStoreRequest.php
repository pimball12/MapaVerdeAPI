<?php

namespace App\Http\Requests;

use App\Models\Garden;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MessageStoreRequest extends FormRequest
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

            'text' => 'required|string|max:255',
            'garden_id'     => [

                'required',
                Rule::in(Garden::all()->pluck('id'))
            ],
            'user_id'     => [

                'required',
                Rule::in(User::all()->pluck('id'))
            ]
        ];
    }
}
