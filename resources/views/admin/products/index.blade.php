@extends('layouts.admin') {{-- Ton layout admin (peut être layouts.app si tu n’as pas de layout spécifique) --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Gestion des Produits</h2>

    <!-- Bouton Ajouter -->
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">➕ Ajouter un produit</a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tableau des produits -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="60" alt="Produit">
                        @else
                            <span class="text-muted">Aucune</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }} Dh</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm" title="Voir">👁️</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm" title="Modifier">✏️</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Supprimer">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Aucun produit trouvé.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
