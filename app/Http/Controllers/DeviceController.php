<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Room;
use App\Models\Category;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     *Affiche la liste des équipements 
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Bonus recherche : si un mot-clé est tapé, on filtre par nom ou marque 
        $devices = Device::with('room')
            ->when($search, function ($query, $search) {
                return $query->where('nom', 'like', "%{$search}%")
                             ->orWhere('marque', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); // Bonus pagination 

        return view('devices.index', compact('devices', 'search'));
    }

    /**
     *Formulaire de création d'un équipement
     */
    public function create()
    {
        $rooms = Room::all(); // Pour la liste déroulante des salles 
        $categories = Category::all(); // Pour les cases à cocher des catégories 
        
        return view('devices.create', compact('rooms', 'categories'));
    }

    /**
     *Enregistrement de l'équipement dans la base de données
     */
    public function store(StoreDeviceRequest $request)
    {
        // Les données sont déjà validées grâce à StoreDeviceRequest 
        $device = Device::create($request->validated());

        // Association des catégories dans la table pivot 
        if ($request->has('categories')) {
            $device->categories()->attach($request->categories);
        }

        // Bonus Message flash de confirmation 
        return redirect()->route('devices.index')
            ->with('success', 'L\'équipement a bien été ajouté au parc !');
    }

    /**
     *Affichage des détails d'un équipement 
     */
    public function show(Device $device)
    {
        // On charge les relations, interventions triées de la plus récente à la plus ancienne
        $device->load([
            'room',
            'categories',
            'interventions' => function ($query) {
                $query->orderBy('date', 'desc');
            },
        ]);

        return view('devices.show', compact('device'));
    }

    /**
     *Formulaire de modification d'un équipement
     */
    public function edit(Device $device)
    {
        $rooms = Room::all();
        $categories = Category::all();
        
        return view('devices.edit', compact('device', 'rooms', 'categories'));
    }

    /**
     *Mise à jour de l'équipement dans la base
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        // Les données sont validées par UpdateDeviceRequest 
        $device->update($request->validated());

        // On synchronise les catégories 
        $device->categories()->sync($request->categories ?? []);

        return redirect()->route('devices.index')
            ->with('success', 'L\'équipement a été mis à jour avec succès !');
    }

    /**
     *Suppression de l'équipement
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'L\'équipement a été retiré du parc.');
    }
}