<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'town_id',
        'street',
        'number',
        'status'
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
