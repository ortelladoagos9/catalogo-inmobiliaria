<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = [
        'province_id',
        'name',
        'postal_code',
        'status'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
