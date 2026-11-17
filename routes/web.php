<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterventionController;



// redirige vers la liste des équipements
Route::get('/', function () {
    return redirect()->route('devices.index');
});

//Les 7 routes du CRUD complet pour les équipements generer automatiquement 
Route::resource('devices', DeviceController::class);

//Gestion des salles pour lister et créer
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show'); // Pour voir les équipements d'une salle

//Gestion des catégories pour lister et créer
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show'); // Pour filtrer par catégorie

//Ajout d'une intervention sur un équipement spécifique
Route::post('/devices/{device}/interventions', [InterventionController::class, 'store'])->name('interventions.store');