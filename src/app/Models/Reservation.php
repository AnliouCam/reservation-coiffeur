<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_nom',
        'client_email',
        'client_telephone',
        'service_id',
        'creneau_id',
        'statut',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function creneau()
    {
        return $this->belongsTo(Creneau::class);
    }
}
