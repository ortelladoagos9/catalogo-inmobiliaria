<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
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
