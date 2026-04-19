<?php

namespace App\Services;

use App\Models\Property;
use App\Models\Address;
use App\Events\PropertyCreated;
use App\Models\Picture;

class PropertyService
{
    public function create(array $data, $user)
    {
        // 1. Crear dirección con updateOrCreate para mejor control
        $address = Address::updateOrCreate(
            [
                'street' => $data['street'],
                'number' => $data['number'] ? (int)$data['number'] : null,
                'town_id' => $data['town_id'],
            ],
            [
                'status' => true,
            ]
        );

        // 2. Armar datos de propiedad
        $propertyData = [
            'user_id' => $user->id,
            'status_id' => $data['status_id'],
            'type_property_id' => $data['type_property_id'],
            'address_id' => $address->id,
            'property_owner_id' => $data['property_owner_id'],
            'title' => $data['title'],
            'price' => $data['price'] ?? null,
            'description' => $data['description'] ?? null,
            'surface' => $data['surface'],
            'rooms' => $data['rooms'] ?? null,
            'status' => true,
        ];

        // 3. crear propiedad
        $property = Property::create($propertyData);

        // 4. guardar imágenes
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('properties', 'public');

                Picture::create([
                    'property_id' => $property->id,
                    'path' => $path,
                ]);
            }
        }

        // 5. disparar evento para enviar email
        event(new PropertyCreated($property));

        return $property;
    }

    public function update(Property $property, array $data, $user)
    {
        // regla: operario no puede modificar precio
        if (!$user->isAdmin()) {
            unset($data['price']);
        }

        // actualizar dirección
        $property->address->update([
            'street' => $data['street'],
            'number' => $data['number'] ? (int)$data['number'] : null,
            'status' => true,
            'town_id' => $data['town_id'],
        ]);

        // actualizar imágenes
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {

                $path = $image->store('properties', 'public');

                Picture::create([
                    'property_id' => $property->id,
                    'path' => $path,
                ]);
            }
        }

        // actualizar propiedad
        $property->update($data);

        return $property;
    }

    public function delete(Property $property)
    {
        $property->update(['status' => false]);
        return $property;
    }
}