@extends('layouts.app')

@section('title', 'Véhicules')

@section('content')
<h2 class="fw-bold mb-4">Nos véhicules</h2>

<form method="GET" action="{{ route('vehicles.public.index') }}" class="card card-modern p-4 mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher une voiture..." value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">Toutes catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <select name="sort" class="form-select">
                <option value="">Trier par</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Plus récents</option>
            </select>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-dark">Filtrer</button>
        <a href="{{ route('vehicles.public.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>
</form>

<div class="row g-4">
    @forelse($vehicles as $vehicle)
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
    @empty
        <div class="col-12">
            <div class="alert alert-info">Aucun véhicule trouvé.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $vehicles->links() }}
</div>
@endsection