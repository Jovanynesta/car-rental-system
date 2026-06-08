@extends('layouts.app')

@section('title', 'Détails véhicule')

@section('content')
<div class="card card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Détails du véhicule</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            @if($vehicle->image)
                <img src="{{ asset('storage/' . $vehicle->image) }}" class="img-fluid rounded-4" alt="Vehicle image">
            @endif
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</h3>
            <p class="text-muted">{{ $vehicle->category->name }}</p>

            <ul class="list-group mb-3">
                <li class="list-group-item">Année : {{ $vehicle->year }}</li>
                <li class="list-group-item">Immatriculation : {{ $vehicle->registration_number }}</li>
                <li class="list-group-item">Prix/jour : {{ number_format($vehicle->price_per_day, 0, ',', ' ') }} FCFA</li>
            </ul>

            <p>{{ $vehicle->description }}</p>

            @auth
                <a href="{{ route('client.reservations.create') }}" class="btn btn-dark">Réserver maintenant</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-dark">Connectez-vous pour réserver</a>
            @endauth
        </div>
    </div>
</div>
@endsection