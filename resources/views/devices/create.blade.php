@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style="animation: fadeInUp 0.4s ease;">
    <div class="col-md-10">
        <div class="card-wow">
            <div class="card-title-wow mb-2">
                <span>Ajouter un nouvel équipement</span>
            </div>
            <p class="text-muted mb-4" style="font-size: 0.9rem;">Tous les champs marqués d'une astérisque (*) sont obligatoires.</p>

            <form action="{{ route('devices.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Nom -->
                    <div class="col-md-12">
                        <label for="nom" class="form-label">Nom de l'équipement *</label>
                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Ex: Projecteur EPSON, PC Dell..." value="{{ old('nom') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Marque -->
                    <div class="col-md-6">
                        <label for="marque" class="form-label">Marque *</label>
                        <input type="text" name="marque" id="marque" class="form-control @error('marque') is-invalid @enderror" placeholder="Ex: Dell, HP, Epson..." value="{{ old('marque') }}">
                        @error('marque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Numéro de série -->
                    <div class="col-md-6">
                        <label for="numero_serie" class="form-label">Numéro de série * (Unique)</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control @error('numero_serie') is-invalid @enderror" placeholder="Ex: SN-89324-X" value="{{ old('numero_serie') }}">
                        @error('numero_serie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- État -->
                    <div class="col-md-6">
                        <label for="etat" class="form-label">État de l'appareil *</label>
                        <select name="etat" id="etat" class="form-select @error('etat') is-invalid @enderror">
                            <option value="neuf" {{ old('etat') == 'neuf' ? 'selected' : '' }}>Neuf</option>
                            <option value="bon" {{ old('etat') == 'bon' ? 'selected' : '' }}>Bon état</option>
                            <option value="en panne" {{ old('etat') == 'en panne' ? 'selected' : '' }}>En panne</option>
                        </select>
                        @error('etat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date d'achat -->
                    <div class="col-md-6">
                        <label for="date_achat" class="form-label">Date d'achat *</label>
                        <input type="date" name="date_achat" id="date_achat" class="form-control @error('date_achat') is-invalid @enderror" value="{{ old('date_achat') }}">
                        @error('date_achat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Salle -->
                    <div class="col-md-12">
                        <label for="room_id" class="form-label">Salle d'affectation *</label>
                        <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror">
                            <option value="">-- Choisir une salle d'affectation --</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->nom }} ({{ $room->batiment }})</option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Catégories associées -->
                    <div class="col-md-12">
                        <label class="form-label d-block mb-3">Catégories Associées</label>
                        <div class="d-flex flex-wrap gap-3 p-3 rounded-3" style="background-color: #f8fafc; border: 1.5px dashed var(--border-color);">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}" {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                    <label class="form-check-label" style="font-weight: 600; color: var(--text-main); cursor: pointer;" for="category_{{ $category->id }}">
                                        {{ $category->nom }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description (Optionnelle)</label>
                        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Détails physiques, spécifications techniques...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Boutons d'Action Uniformes -->
                <div class="d-flex justify-content-end gap-3 mt-5 pt-3" style="border-top: 1px solid var(--border-color);">
                    <a href="{{ route('devices.index') }}" class="btn-wow btn-wow-danger text-decoration-none">Annuler</a>
                    <button type="submit" class="btn-wow btn-wow-primary">Enregistrer l'équipement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection