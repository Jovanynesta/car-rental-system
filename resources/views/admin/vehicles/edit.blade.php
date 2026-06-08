@extends('layouts.app')

@section('title', 'Modifier un véhicule')

@section('content')
<div class="card card-modern p-4">
    <h2 class="fw-bold mb-4">Modifier un véhicule</h2>

    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Marque</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $vehicle->brand) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Modèle</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle->model) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Année</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $vehicle->year) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Immatriculation</label>
                <input type="text" name="registration_number" class="form-control" value="{{ old('registration_number', $vehicle->registration_number) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Choisir --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $vehicle->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prix par jour</label>
                <input type="number" name="price_per_day" class="form-control" value="{{ old('price_per_day', $vehicle->price_per_day) }}">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $vehicle->description) }}</textarea>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Photo véhicule</label>
                <input type="file" name="image" class="form-control">
                @if($vehicle->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $vehicle->image) }}" width="120" class="rounded">
                    </div>
                @endif
            </div>
        </div>

        <button class="btn btn-dark">Mettre à jour</button>
    </form>
</div>
@endsection