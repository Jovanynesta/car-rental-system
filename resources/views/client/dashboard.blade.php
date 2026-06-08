@extends('layouts.app')

@section('title', 'Dashboard Client')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Mon espace client</h2>
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
</div>

<div class="card card-modern p-4 mb-4">
    <h5 class="fw-bold">Informations personnelles</h5>
    <p class="mb-1"><strong>Nom :</strong> {{ $user->name }}</p>
    <p class="mb-1"><strong>Email :</strong> {{ $user->email }}</p>
    <p class="mb-0"><strong>Rôle :</strong> {{ $user->role }}</p>
</div>

<div class="card card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Mes réservations</h5>
        <a href="{{ route('vehicles.public.index') }}" class="btn btn-outline-dark btn-sm">Voir les véhicules</a>
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Véhicule</th>
                <th>Dates</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</td>
                    <td>{{ $reservation->start_date->format('d/m/Y') }} - {{ $reservation->end_date->format('d/m/Y') }}</td>
                    <td>{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $reservation->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune réservation trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
