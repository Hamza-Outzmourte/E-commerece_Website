@extends('layouts.app')

@section('title', 'Détail de l\'avis')

@section('content')
<div class="p-8 max-w-3xl mx-auto bg-white rounded shadow">
  <h2 class="text-xl font-bold mb-4 text-gray-800">Détail de l’avis</h2>

  <p><strong>Utilisateur :</strong> {{ $review->user->name }}</p>
  <p><strong>Produit :</strong> {{ $review->product->name }}</p>
  <p><strong>Note :</strong> {{ $review->rating }}/5</p>
  <p><strong>Commentaire :</strong></p>
  <p class="bg-gray-100 p-4 rounded mt-2">{{ $review->comment }}</p>

  <div class="mt-6 flex gap-4">
    <a href="{{ route('admin.reviews.index') }}" class="text-blue-600 hover:underline">← Retour</a>
    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
      @csrf @method('DELETE')
      <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cet avis ?')">Supprimer</button>
    </form>
  </div>
</div>
@endsection
