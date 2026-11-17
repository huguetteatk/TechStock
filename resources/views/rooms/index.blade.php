@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Formulaire (Card-Wow avec accent vert de succès) -->
    <div class="col-md-4 mb-4" style="animation: fadeInUp 0.4s ease;">
        <div class="card-wow card-wow-success">
            <div class="card-title-wow">Créer une salle</div>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la salle *</label>
                    <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Ex: Salle 101" value="{{ old('nom') }}">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="batiment" class="form-label">Bâtiment *</label>
                    <input type="text" name="batiment" id="batiment" class="form-control @error('batiment') is-invalid @enderror" placeholder="Ex: Bâtiment A" value="{{ old('batiment') }}">
                    @error('batiment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="capacite" class="form-label">Capacité (personnes) *</label>
                    <input type="number" name="capacite" id="capacite" class="form-control @error('capacite') is-invalid @enderror" placeholder="Ex: 25" value="{{ old('capacite') }}">
                    @error('capacite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-wow btn-wow-success w-100">Enregistrer la salle</button>
            </form>
        </div>
    </div>

    <!-- Tableau (Card-Wow classique) -->
    <div class="col-md-8 mb-4" style="animation: fadeInUp 0.5s ease;">
        <div class="card-wow p-0">
            <div style="padding: 1.5rem 2rem; border-bottom: 2px solid var(--border-color); background-color: #f8fafc;">
                <h5 class="mb-0" style="font-weight: 800; color: var(--text-main);">Salles configurées</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr style="font-size: 0.8rem; color: var(--text-muted); font-weight: bold; text-transform: uppercase;">
                            <th class="ps-4 py-3">Nom</th>
                            <th class="py-3">Bâtiment</th>
                            <th class="py-3">Capacité</th>
                            <th class="py-3">Équipements</th>
                            <th class="pe-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr style="border-bottom: 1px solid var(--border-color); font-size: 0.95rem;">
                                <td class="ps-4"><strong>{{ $room->nom }}</strong></td>
                                <td>{{ $room->batiment }}</td>
                                <td>{{ $room->capacite }} places</td>
                                <td>
                                    <span class="badge" style="background-color: #e0f2fe; color: #0369a1; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                        {{ $room->devices_count ?? 0 }} équipement(s)
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('rooms.show', $room) }}" class="btn-wow btn-wow-outline py-1 px-3" style="font-size: 0.8rem;">Gérer le parc</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Aucune salle disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection