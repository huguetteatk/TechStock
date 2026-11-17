<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
{
    /**
     * Autorise l'utilisateur à faire cette requête.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Les règles de validation qui s'appliquent à la requête.
     */
    public function rules(): array
    {
        return [
            'nom'          => 'required|string|min:3|max:100',
            'marque'       => 'required|string|min:2|max:50',
            // Le numéro de série doit être unique dans la table 'devices'
            'numero_serie' => 'required|string|max:100|unique:devices,numero_serie',
            'etat'         => 'required|string|in:neuf,bon,en panne', // Pour tes badges de couleur bonus !
            'date_achat'   => 'required|date|before_or_equal:today',
            'description'  => 'nullable|string|max:1000',
            // On vérifie que la salle sélectionnée existe bien dans la table 'rooms'
            'room_id'      => 'required|exists:rooms,id',
            // Tableau des catégories sélectionnées 
            'categories'   => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}