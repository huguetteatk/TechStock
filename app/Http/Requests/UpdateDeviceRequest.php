<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        // On récupère l'identifiant du device depuis la route 
        $deviceId = $this->route('device'); 

        return [
            'nom'          => 'required|string|min:3|max:100',
            'marque'       => 'required|string|min:2|max:50',
            // On rend unique le numéro de série mais on ignore celui du device en cours de modification
            'numero_serie' => 'required|string|max:100|unique:devices,numero_serie,' . $this->route('device')->id,
            'etat'         => 'required|string|in:neuf,bon,en panne',
            'date_achat'   => 'required|date|before_or_equal:today',
            'description'  => 'nullable|string|max:1000',
            'room_id'      => 'required|exists:rooms,id',
            'categories'   => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}