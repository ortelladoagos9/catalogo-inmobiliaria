<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'surface' => 'sometimes|required|numeric|min:0',
            'rooms' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',

            'status_id' => 'sometimes|required|exists:statuses,id',
            'type_property_id' => 'sometimes|required|exists:type_properties,id',
            'property_owner_id' => 'sometimes|required|exists:property_owners,id',
            'town_id' => 'sometimes|required|exists:towns,id',
            
            'street' => 'sometimes|required|string|max:255',
            'number' => 'nullable|integer',

            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
