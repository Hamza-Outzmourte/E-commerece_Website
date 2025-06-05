@extends('layouts.app')

@section('title', 'Gestion des Avis')

@section('content')
<div class="p-8">
  <h1 class="text-2xl font-bold mb-6 text-gray-800">Liste des avis</h1>

  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
  @endif

  <div class="overflow-x-auto">
    <table class="w-full bg-white rounded shadow">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="p-3">Utilisateur</th>
          <th class="p-3">Produit</th>
          <th class="p-3">Note</th>
          <th class="p-3">Commentaire</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reviews as $review)
          <tr class="border-t">
            <td class="p-3">{{ $review->user->name }}</td>
            <td class="p-3">{{ $review->product->name }}</td>
            <td class="p-3 text-yellow-500">
              {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
            </td>
            <td class="p-3">{{ Str::limit($review->comment, 50) }}</td>
            <td class="p-3 space-x-2">
              <a href="{{ route('admin.reviews.show', $review->id) }}" class="text-blue-600 hover:underline">Voir</a>
              <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cet avis ?')">Supprimer</button>
              </form>
              @if(!$review->approved)
                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" class="text-green-600 hover:underline">Approuver</button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="p-4 text-center text-gray-500">Aucun avis disponible.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    {{ $reviews->links() }}
  </div>
</div>
@endsection
