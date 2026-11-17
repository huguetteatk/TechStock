@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" style="animation: fadeInUp 0.3s ease;">
    <h1 style="font-weight: 800; letter-spacing: -1px; color: var(--text-main);">Parc Informatique</h1>
    <a href="{{ route('devices.create') }}" class="btn-wow btn-wow-primary">+ Ajouter un équipement</a>
</div>

<!-- Formulaire de recherche -->
<div class="card-wow mb-4" style="animation-delay: 0.1s;">
    <form action="{{ route('devices.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-10">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou marque" value="{{ $search ?? '' }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn-wow btn-wow-primary w-100">Rechercher</button>
        </div>
    </form>
</div>

<!-- Tableau uniforme -->
<div class="card-wow p-0" style="animation-delay: 0.2s;">
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead style="background-color: #f8fafc; border-bottom: 2px solid var(--border-color);">
                <tr style="font-size: 0.8rem; color: var(--text-muted); font-weight: bold; text-transform: uppercase;">
                    <th class="ps-4 py-3">Nom</th>
                    <th class="py-3">Marque</th>
                    <th class="py-3">N° Série</th>
                    <th class="py-3">État</th>
                    <th class="py-3">Salle</th>
                    <th class="pe-4 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($devices as $device)
                    <tr style="border-bottom: 1px solid var(--border-color); font-size: 0.95rem;">
                        <td class="ps-4">
                            <a href="{{ route('devices.show', $device) }}" style="color: var(--text-main); font-weight: 700; text-decoration: none;">
                                {{ $device->nom }}
                            </a>
                        </td>
                        <td>{{ $device->marque }}</td>
                        <td><code style="color: var(--primary); font-weight: 700;">{{ $device->numero_serie }}</code></td>
                        <td>
                            @if($device->etat === 'neuf')
                                <span class="badge bg-success-subtle text-success badge-wow" style="background-color: #d1fae5; color: #065f46;">Neuf</span>
                            @elseif($device->etat === 'bon')
                                <span class="badge bg-warning-subtle text-warning badge-wow" style="background-color: #fef3c7; color: #92400e;">Bon état</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger badge-wow" style="background-color: #fee2e2; color: #991b1b;">En panne</span>
                            @endif
                        </td>
                        <td><span style="font-weight: 600;">{{ $device->room->nom ?? 'Non assignée' }}</span></td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('devices.show', $device) }}" class="btn-wow btn-wow-primary py-1 px-3" style="font-size: 0.8rem;">Voir</a>
                                <a href="{{ route('devices.edit', $device) }}" class="btn-wow btn-wow-outline py-1 px-3" style="font-size: 0.8rem;">Modifier</a>
                                <form action="{{ route('devices.destroy', $device) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet appareil ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-wow btn-wow-danger py-1 px-3" style="font-size: 0.8rem;">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Aucun équipement disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">
    {{ $devices->appends(['search' => $search])->links() }}
</div>
@endsection