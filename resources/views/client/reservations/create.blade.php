@extends('layouts.app')

@section('title', 'Réserver un véhicule')

@section('content')
<div class="card card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Nouvelle réservation</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>

    <form action="{{ route('client.reservations.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Choisir un véhicule</label>
                <select name="vehicle_id" class="form-select">
                    <option value="">-- Sélectionner --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->brand }} {{ $vehicle->model }} - {{ number_format($vehicle->price_per_day, 0, ',', ' ') }} FCFA/jour
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jour de prise</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Durée (en jours)</label>
                <input type="number" name="duration_days" class="form-control" min="1" value="{{ old('duration_days', 1) }}">
                @error('duration_days')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Prix final estimé</label>
                <input type="text" class="form-control" value="Le total sera calculé après validation" disabled>
            </div>
        </div>

        <button class="btn btn-dark">Confirmer la réservation</button>
    </form>
</div>
@endsection