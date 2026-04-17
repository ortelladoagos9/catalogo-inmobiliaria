<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable; // Importar la interfaz Auditable
use Illuminate\Database\Eloquent\Model;

class Property extends Model implements Auditable // Implementar la interfaz Auditable
{
    use \OwenIt\Auditing\Auditable; // Usar el trait Auditable

    protected $fillable = [
        'user_id',
        'status_id',
        'type_property_id',
        'address_id',
        'property_owner_id',
        'title',
        'price',
        'description',
        'surface',
        'rooms',
        'status'
    ];
    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function typeProperty()
    {
        return $this->belongsTo(TypeProperty::class);
    }
    public function picture()
    {
        return $this->hasMany(Picture::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class, 'property_owner_id');
    }
}
