@extends('layouts.app')

@section('title', 'Gestion des véhicules')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Gestion des véhicules</h2>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-dark">+ Ajouter un véhicule</a>
</div>

<div class="card card-modern p-4">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Catégorie</th>
                <th>Prix/jour</th>
                <th>Immatriculation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" width="70" height="50" style="object-fit: cover;" class="rounded">
                        @else
                            <span class="text-muted">Aucune</span>
                        @endif
                    </td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->category->name ?? '-' }}</td>
                    <td>{{ number_format($vehicle->price_per_day, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $vehicle->registration_number }}</td>
                    <td>
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-sm btn-primary">Modifier</a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce véhicule ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun véhicule trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection