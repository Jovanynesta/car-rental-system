@extends('layouts.app')

@section('title', 'Détail réservation admin')

@section('content')
<div class="card card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Détail de la réservation</h2>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">← Retour</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if($reservation->vehicle->image)
                <img src="{{ asset('storage/' . $reservation->vehicle->image) }}" class="img-fluid rounded-4 mb-3" alt="Vehicle image">
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>Client :</strong> {{ $reservation->user->name }}</p>
            <p><strong>Email :</strong> {{ $reservation->user->email }}</p>
            <p><strong>Véhicule :</strong> {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</p>
            <p><strong>Prix journalier :</strong> {{ number_format($reservation->vehicle->price_per_day, 0, ',', ' ') }} FCFA</p>
            <p><strong>Date de prise :</strong> {{ $reservation->start_date->format('d/m/Y') }}</p>
            <p><strong>Date de retour :</strong> {{ $reservation->end_date->format('d/m/Y') }}</p>
            <p><strong>Durée :</strong> {{ $reservation->start_date->diffInDays($reservation->end_date) + 1 }} jour(s)</p>
            <p><strong>Total facture :</strong> {{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut actuel :</strong> {{ $reservation->status }}</p>
        </div>
    </div>

    <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Changer le statut</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    <option value="completed" {{ $reservation->status === 'completed' ? 'selected' : '' }}>Terminée</option>
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <button class="btn btn-dark">Mettre à jour</button>
            </div>
        </div>
    </form>
</div>
@endsection