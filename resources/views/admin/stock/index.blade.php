@extends('layouts.app')

@section('content')
<div class="p-6">
  <h1 class="text-xl font-bold mb-4">Gestion du Stock</h1>

  <a href="{{ route('admin.stock.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter Stock</a>
    <a href="{{ route('admin.stock.sync') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Synchroniser le stock</a>

  <table class="min-w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-200">
      <tr>
        <th class="p-3 text-left">Produit</th>
        <th class="p-3 text-left">Quantité</th>
        <th class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($stocks as $stock)
        <tr class="border-t">
          <td class="p-3">{{ $stock->product->name }}</td>
          <td class="p-3">{{ $stock->quantity }}</td>
          <td class="p-3 flex space-x-2">
            <a href="{{ route('admin.stock.edit', $stock) }}" class="text-blue-600">Modifier</a>
            <form action="{{ route('admin.stock.destroy', $stock) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600">Supprimer</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="3" class="p-3 text-center">Aucun stock</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
