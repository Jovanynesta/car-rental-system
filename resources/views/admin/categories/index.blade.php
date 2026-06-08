@extends('layouts.app')

@section('title', 'Catégories')

@section('content')
<h2 class="fw-bold mb-4">Catégories de véhicules</h2>

<div class="card card-modern p-4">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <th>Actions</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucune catégorie</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection