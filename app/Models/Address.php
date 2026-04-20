<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; 

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
