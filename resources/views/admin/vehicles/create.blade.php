@extends('layouts.app')

@section('title', 'Ajouter un véhicule')

@section('content')
<div class="card card-modern p-4">
    <h2 class="fw-bold mb-4">Ajouter un véhicule</h2>

    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Marque</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Modèle</label>
                <input type="text" name="model" class="form-control" value="{{ old('model') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Année</label>
                <input type="number" name="year" class="form-control" value="{{ old('year') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Immatriculation</label>
                <input type="text" name="registration_number" class="form-control" value="{{ old('registration_number') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Choisir --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prix par jour</label>
                <input type="number" name="price_per_day" class="form-control" value="{{ old('price_per_day') }}">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Photo véhicule</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>

        <button class="btn btn-dark">Enregistrer</button>
    </form>
</div>
@endsection