<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['nom', 'duree', 'prix'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
