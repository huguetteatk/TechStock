<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;

class RoomController extends Controller
{
    // Lister toutes les salles
    public function index()
    {
        // Bonus optionnel : on récupère les salles avec le nombre d'équipements pour le barème bonus 
        $rooms = Room::withCount('devices')->get();
        return view('rooms.index', compact('rooms'));
    }

    // Enregistrer une nouvelle salle
    public function store(StoreRoomRequest $request)
        {
            Room::create($request->validated());

            return redirect()->route('rooms.index')
                ->with('success', 'La salle a bien été créée !');
        }

    // Voir le détail d'une salle avec ses équipements associés
    public function show(Room $room)
    {
        // On charge les équipements de cette salle
        $room->load('devices');
        return view('rooms.show', compact('room'));
    }
}