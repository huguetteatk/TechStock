<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Http\Requests\StoreInterventionRequest;

class InterventionController extends Controller
{
    // Enregistrer une intervention sur un équipement précis
    public function store(StoreInterventionRequest $request, Device $device)
    {
        $device->interventions()->create($request->validated());

        return redirect()->route('devices.show', $device)
            ->with('success', 'L\'intervention a bien été enregistrée dans l\'historique !');
    }
}