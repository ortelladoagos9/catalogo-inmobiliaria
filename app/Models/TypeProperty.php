<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProperty extends Model
{
    protected $fillable = [
        'description',
        'status'
    ];

    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
