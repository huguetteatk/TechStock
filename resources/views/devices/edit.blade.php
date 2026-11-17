@extends('layouts.app')

@section('content')
<div class="card shadow-sm max-width-md mx-auto">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0 text-dark">Modifier l'équipement : {{ $device->nom }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('devices.update', $device) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'équipement</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $device->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="marque" class="form-label">Marque</label>
                <input type="text" name="marque" id="marque" class="form-control @error('marque') is-invalid @enderror" value="{{ old('marque', $device->marque) }}">
                @error('marque')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="numero_serie" class="form-label">Numéro de série</label>
                <input type="text" name="numero_serie" id="numero_serie" class="form-control @error('numero_serie') is-invalid @enderror" value="{{ old('numero_serie', $device->numero_serie) }}">
                @error('numero_serie')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="etat" class="form-label">État de l'appareil</label>
                    <select name="etat" id="etat" class="form-select @error('etat') is-invalid @enderror">
                        <option value="neuf" {{ old('etat', $device->etat) == 'neuf' ? 'selected' : '' }}>Neuf</option>
                        <option value="bon" {{ old('etat', $device->etat) == 'bon' ? 'selected' : '' }}>Bon état</option>
                        <option value="en panne" {{ old('etat', $device->etat) == 'en panne' ? 'selected' : '' }}>En panne</option>
                    </select>
                    @error('etat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_achat" class="form-label">Date d'achat</label>
                    <input type="date" name="date_achat" id="date_achat" class="form-control @error('date_achat') is-invalid @enderror" value="{{ old('date_achat', $device->date_achat) }}">
                    @error('date_achat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Salle d'affectation</label>
                <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $device->room_id) == $room->id ? 'selected' : '' }}>
                            {{ $room->nom }} (Bâtiment {{ $room->batiment }})
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Catégories de l'équipement</label>
                <div class="border rounded p-3 bg-white">
                    @forelse($categories as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}"
                                {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || (!old('categories') && $device->categories->contains($category->id)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->nom }}
                            </label>
                        </div>
                    @empty
                        <span class="text-muted small">Aucune catégorie disponible.</span>
                    @endforelse
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description (Optionnelle)</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $device->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <button type="submit" class="btn btn-warning text-dark">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@endsection