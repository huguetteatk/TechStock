<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    // Les champs autorisés pour la création/modification d'une salle
    protected $fillable = [
        'nom', 
        'batiment', 
        'capacite'
    ];

    // Une salle possède plusieurs équipements 
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }
}