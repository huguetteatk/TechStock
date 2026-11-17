@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card-wow">
            <div class="card-title-wow">
                <span>Détails de l'équipement</span>
                <a href="{{ route('devices.edit', $device) }}" class="btn-wow btn-wow-outline py-1 px-3" style="font-size: 0.8rem;">Modifier</a>
            </div>

            <h3 class="text-primary" style="font-weight: 800;">{{ $device->nom }}</h3>
            <h6 class="text-muted mb-3">Marque : <strong>{{ $device->marque }}</strong></h6>

            <hr>

            <p><strong>Numéro de série :</strong> <code>{{ $device->numero_serie }}</code></p>
            <p><strong>Salle d'affectation :</strong>
                @if($device->room)
                    <a href="{{ route('rooms.show', $device->room) }}">{{ $device->room->nom }}</a> (Bâtiment {{ $device->room->batiment }})
                @else
                    <span class="text-muted">Non assigné</span>
                @endif
            </p>
            <p><strong>Date d'achat :</strong> {{ \Carbon\Carbon::parse($device->date_achat)->format('d/m/Y') }}</p>
            <p><strong>État :</strong>
                @if($device->etat === 'neuf')
                    <span class="badge bg-success">Neuf</span>
                @elseif($device->etat === 'bon')
                    <span class="badge bg-warning text-dark">Bon état</span>
                @else
                    <span class="badge bg-danger">En panne</span>
                @endif
            </p>

            <p><strong>Description :</strong></p>
            <p class="bg-light p-3 rounded border text-secondary">{{ $device->description ?? 'Aucune description fournie.' }}</p>

            <p><strong>Catégories liées :</strong></p>
            <div>
                @forelse($device->categories as $category)
                    <span class="badge bg-secondary p-2 me-1">{{ $category->nom }}</span>
                @empty
                    <span class="text-muted small">Aucune catégorie associée à cet équipement.</span>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card-wow mb-4">
            <div class="card-title-wow">
                <span>Historique des Interventions</span>
                <span class="badge-wow" style="background-color: #f1f5f9; color: #475569; border: 1px solid var(--border-color);">
                    {{ $device->interventions->count() }}
                </span>
            </div>
            <div style="max-height: 300px; overflow-y: auto;">
                @forelse($device->interventions as $intervention)
                    <div class="border-start border-4 ps-3 mb-3" style="border-color: var(--primary) !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>{{ $intervention->type }}</strong>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($intervention->date)->format('d/m/Y') }}</small>
                        </div>
                        <p class="mb-0 text-secondary small mt-1">{{ $intervention->commentaire }}</p>
                    </div>
                @empty
                    <p class="text-center text-muted py-4 mb-0">Aucune intervention enregistrée sur cet équipement.</p>
                @endforelse
            </div>
        </div>

        <div class="card-wow card-wow-success">
            <div class="card-title-wow">Déclarer une nouvelle intervention</div>
            <form action="{{ route('interventions.store', $device) }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date *</label>
                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type *</label>
                        <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="Ex: Panne, Maintenance" value="{{ old('type') }}">
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label for="commentaire" class="form-label">Commentaire *</label>
                    <textarea name="commentaire" id="commentaire" rows="3" class="form-control @error('commentaire') is-invalid @enderror" placeholder="Décrivez les actions menées...">{{ old('commentaire') }}</textarea>
                    @error('commentaire')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-wow btn-wow-success w-100 mt-4">Enregistrer l'intervention</button>
            </form>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('devices.index') }}" class="btn-wow btn-wow-outline">⬅ Retour à la liste</a>
</div>
@endsection