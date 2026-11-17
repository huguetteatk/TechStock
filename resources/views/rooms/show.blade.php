@extends('layouts.app')

@section('content')
<div class="mb-4" style="animation: fadeInUp 0.3s ease;">
    <a href="{{ route('rooms.index') }}" class="btn-wow btn-wow-outline mb-4">← Retour aux salles</a>
    
    <!-- En-tête de la Salle Stylisé -->
    <div class="card-wow" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Détails de la salle</span>
                <h1 class="mt-1 mb-0" style="font-weight: 800; letter-spacing: -1px; color: var(--text-main);">Salle : {{ $room->nom }}</h1>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge-wow" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;">🏢 Bâtiment : {{ $room->batiment }}</span>
                <span class="badge-wow" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">👥 Capacité : {{ $room->capacite }} personnes</span>
            </div>
        </div>
    </div>
</div>

<!-- Liste des équipements dans cette salle -->
<div class="card-wow p-0" style="animation: fadeInUp 0.4s ease; animation-delay: 0.1s;">
    <div style="padding: 1.5rem 2rem; border-bottom: 2px solid var(--border-color); background-color: #f8fafc;">
        <h5 class="mb-0" style="font-weight: 800; color: var(--text-main);">Équipements installés dans cette salle</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr style="font-size: 0.8rem; color: var(--text-muted); font-weight: bold; text-transform: uppercase;">
                    <th class="ps-4 py-3">Nom</th>
                    <th class="py-3">Marque</th>
                    <th class="py-3">N° Série</th>
                    <th class="py-3">État</th>
                    <th class="pe-4 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($room->devices as $device)
                    <tr style="border-bottom: 1px solid var(--border-color); font-size: 0.95rem;">
                        <td class="ps-4"><strong>{{ $device->nom }}</strong></td>
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
                        <td class="pe-4 text-end">
                            <a href="{{ route('devices.edit', $device) }}" class="btn-wow btn-wow-outline py-1 px-3" style="font-size: 0.8rem;">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Aucun équipement n'est affecté à cette salle pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection