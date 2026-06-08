@extends('layouts.app')

@section('title', 'Facture réservation')

@section('content')
<div class="card card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Facture de réservation</h2>
        <a href="{{ route('client.reservations.index') }}" class="btn btn-outline-secondary">← Retour</a>
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
            <p><strong>Statut :</strong> {{ $reservation->status }}</p>
        </div>
    </div>
</div>
@endsection