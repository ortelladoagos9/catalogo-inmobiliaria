<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'description',
        'status'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
