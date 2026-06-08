@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Dashboard Admin</h2>
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-modern p-3">
            <div class="text-muted">Véhicules total</div>
            <h3 class="fw-bold">{{ $totalVehicles }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-modern p-3">
            <div class="text-muted">Véhicules disponibles</div>
            <h3 class="fw-bold">{{ $availableVehicles }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-modern p-3">
            <div class="text-muted">Réservations</div>
            <h3 class="fw-bold">{{ $totalReservations }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-modern p-3">
            <div class="text-muted">Utilisateurs</div>
            <h3 class="fw-bold">{{ $totalUsers }}</h3>
        </div>
    </div>
</div>

<div class="card card-modern p-4 mb-4">
    <h5 class="fw-bold mb-3">Revenus générés</h5>
    <h3 class="text-success">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</h3>
</div>

<div class="card card-modern p-4">
    <h5 class="fw-bold mb-3">Dernières réservations</h5>
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Client</th>
                <th>Véhicule</th>
                <th>Dates</th>
                <th>Statut</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentReservations as $reservation)
                <tr>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</td>
                    <td>{{ $reservation->start_date->format('d/m/Y') }} - {{ $reservation->end_date->format('d/m/Y') }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune réservation récente</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
