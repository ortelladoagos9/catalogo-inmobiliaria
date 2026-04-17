<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyOwner extends Model
{
    protected $fillable = [
        'id_number',
        'name',
        'email',
        'phone_number',
        'status'
    ];

    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
