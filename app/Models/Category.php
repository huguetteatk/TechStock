<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    // Le champ autorisé pour la création 
    protected $fillable = ['nom'];

    // Une catégorie possède plusieurs équipements 
    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class);
    }
}