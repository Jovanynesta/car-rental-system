@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="p-5 mb-4 bg-white rounded-4 shadow-sm">
    <div class="container py-4">
        <h1 class="display-5 fw-bold">Car Rental System</h1>
        <p class="col-md-8 fs-5 text-muted">Réservez des véhicules facilement, rapidement et en toute sécurité.</p>
        <a href="{{ route('vehicles.public.index') }}" class="btn btn-dark btn-lg">Voir les véhicules</a>
    </div>
</div>

<h3 class="mb-4 fw-bold">Véhicules récents</h3>

<div class="row g-4">
    @foreach($vehicles as $vehicle)
        <div class="col-md-4">
            <div class="card card-modern h-100 overflow-hidden">
                @if($vehicle->image)
                    <img src="{{ asset('storage/' . $vehicle->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="Vehicle image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->brand }} {{ $vehicle->model }}</h5>
                    <p class="text-muted mb-2">{{ $vehicle->category->name }}</p>
                    <p class="fw-bold">{{ number_format($vehicle->price_per_day, 0, ',', ' ') }} FCFA / jour</p>
                    <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-outline-dark btn-sm">Détails</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection