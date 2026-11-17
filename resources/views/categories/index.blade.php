@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Formulaire (Card-Wow avec accent vert) -->
    <div class="col-md-4 mb-4" style="animation: fadeInUp 0.4s ease;">
        <div class="card-wow card-wow-success">
            <div class="card-title-wow">Ajouter une catégorie</div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="form-label">Nom de la catégorie *</label>
                    <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Ex: Réseaux" value="{{ old('nom') }}">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-wow btn-wow-success w-100">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- Tableau des catégories -->
    <div class="col-md-8 mb-4" style="animation: fadeInUp 0.5s ease;">
        <div class="card-wow p-0">
            <div style="padding: 1.5rem 2rem; border-bottom: 2px solid var(--border-color); background-color: #f8fafc;">
                <h5 class="mb-0" style="font-weight: 800; color: var(--text-main);">Catégories disponibles</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr style="font-size: 0.8rem; color: var(--text-muted); font-weight: bold; text-transform: uppercase;">
                            <th class="ps-4 py-3">Nom de la catégorie</th>
                            <th class="py-3">Équipements associés</th>
                            <th class="pe-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr style="border-bottom: 1px solid var(--border-color); font-size: 0.95rem;">
                                <td class="ps-4"><strong>{{ $category->nom }}</strong></td>
                                <td>
                                    <span class="badge" style="background-color: #f1f5f9; color: #475569; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                        {{ $category->devices_count ?? 0 }} équipement(s)
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('categories.show', $category) }}" class="btn-wow btn-wow-outline py-1 px-3" style="font-size: 0.8rem;">Filtrer</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">Aucune catégorie disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection