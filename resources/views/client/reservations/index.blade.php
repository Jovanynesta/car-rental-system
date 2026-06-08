@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Mes réservations</h2>
    <div class="d-flex gap-2">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
        <a href="{{ route('client.reservations.create') }}" class="btn btn-dark">Nouvelle réservation</a>
    </div>
</div>

<div class="card card-modern p-4">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Véhicule</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Durée</th>
                <th>Prix total</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</td>
                    <td>{{ $reservation->start_date->format('d/m/Y') }}</td>
                    <td>{{ $reservation->end_date->format('d/m/Y') }}</td>
                    <td>{{ $reservation->start_date->diffInDays($reservation->end_date) + 1 }} jour(s)</td>
                    <td>{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'cancelled' ? 'danger' : 'warning text-dark') }}">
                            {{ $reservation->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('client.reservations.show', $reservation) }}" class="btn btn-sm btn-primary">Facture</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune réservation</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $reservations->links() }}
    </div>
</div>
@endsection