<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intervention extends Model
{
    // Les champs autorisés pour l'intervention 
    protected $fillable = [
        'date', 
        'type', 
        'commentaire', 
        'device_id'
    ];

    // Une intervention appartient à un équipement 
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}