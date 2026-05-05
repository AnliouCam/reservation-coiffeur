<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    protected $fillable = ['date', 'heure', 'disponible'];

    protected $casts = [
        'disponible' => 'boolean',
        'date' => 'date',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
