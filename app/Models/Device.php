<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Device extends Model
{
    // Les champs autorisés pour la création ou la modification 
    protected $fillable = [
        'nom', 
        'marque', 
        'numero_serie', 
        'etat', 
        'date_achat', 
        'description', 
        'room_id'
    ];

    // Un équipement appartient à une seule salle 
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // Un équipement peut avoir plusieurs interventions 
    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class);
    }

    // Un équipement est lié à plusieurs catégories 
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}