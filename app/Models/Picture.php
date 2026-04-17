<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'property_id',
        'path',
        'status'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
