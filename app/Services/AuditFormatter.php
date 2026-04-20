<?php

namespace App\Services;

use App\Models\Status;
use App\Models\TypeProperty;
use App\Models\Address;
use App\Models\PropertyOwner;
use App\Models\Town;

class AuditFormatter
{
    public static function format($audit)
    {
        return [
            'old' => self::mapValues($audit->old_values ?? [], $audit),
            'new' => self::mapValues($audit->new_values ?? [], $audit)
        ];
    }

    private static function mapValues($values, $audit)
    {
        $formatted = [];

        foreach ($values as $key => $value) {

            // ocultar campos que no querés mostrar
            if ($key === 'user_id' || $key === 'id') {
                continue;
            }

            $result = self::transform($key, $value, $audit);

            if ($result === null) {
                continue;
            }

            [$label, $val] = $result;

            $formatted[] = [
                'label' => $label,
                'value' => $val
            ];
            
        }     

        return $formatted;
    }

    private static function transform($key, $value, $audit)
    {
        if ($audit->auditable_type === Address::class && $key === 'status') {
            return null; // no mostrar status de address
        }
        switch ($key) {

            case 'status_id':
                return ['Disponibilidad', Status::find($value)?->description];

            case 'type_property_id':
                return ['Tipo de propiedad', TypeProperty::find($value)?->description];

            case 'property_owner_id':
                return ['Responsable', PropertyOwner::find($value)?->name];

            case 'address_id':
                $address = Address::with('town.province')->find($value);

                if (!$address) return ['Dirección', '—'];

                return ['Dirección', "{$address->street} {$address->number}, {$address->town->name}, {$address->town->province->name}"];

            case 'street':
                return ['Calle', $value];
            
            case 'number':
                return ['Número', $value];

            case 'town_id':
                $town = Town::with('province')->find($value);

                if (!$town) return ['Localidad', '—'];

                return [
                    'Localidad y provincia',
                    "{$town->name}, {$town->province->name}"
                ];

            case 'title':
                return ['Título', $value];

            case 'price':
                return ['Precio', '$' . number_format($value, 2, ',', '.')];

            case 'description':
                return ['Descripción', $value];

            case 'surface':
                return ['Superficie', $value . ' m²'];

            case 'rooms':
                return ['Ambientes', $value];

            case 'status':
                return ['Estado', $value ? 'Activo' : 'Inactivo'];

            default:
                return [ucfirst(str_replace('_', ' ', $key)), $value];
        }
    }
    public static function resolveEvent($audit)
    {
        // Si es update, revisamos si en realidad fue "eliminación lógica"
        if ($audit->event === 'updated') {

            $old = $audit->old_values ?? [];
            $new = $audit->new_values ?? [];

            if (
                isset($old['status']) &&
                isset($new['status']) &&
                $old['status'] == 1 &&
                $new['status'] == 0
            ) {
                return 'deleted'; // fuerza eliminado
            }
        }

        return $audit->event;
    }
}