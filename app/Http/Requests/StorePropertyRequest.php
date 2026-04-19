<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->user()->isOperario();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|regex:/[a-zA-Z]/',
            'description' => 'nullable|string',
            'surface' => 'required|numeric|min:0',
            'rooms' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',

            'status_id' => 'required|exists:statuses,id',
            'type_property_id' => 'required|exists:type_properties,id',
            'property_owner_id' => 'required|exists:property_owners,id',
            'town_id' => 'required|exists:towns,id',

            'street' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'number' => 'nullable|integer|min:0',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'El título debe contener al menos una letra.',
            'street.regex' => 'La calle solo puede contener letras y espacios.',
            'surface.min' => 'La superficie debe ser mayor o igual a 0.',
            'rooms.min' => 'Los ambientes deben ser mayor o igual a 0.',
            'price.min' => 'El precio debe ser mayor o igual a 0.',
        ];
    }
}
