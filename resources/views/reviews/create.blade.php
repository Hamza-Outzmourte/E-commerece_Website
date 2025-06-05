@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
    Laisser un avis pour : {{ $product->name }}
  </h1>

  <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
    @csrf

    <div>
      <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note *</label>
      <select name="rating" id="rating" class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:text-white border-gray-300" required>
        <option value="">-- Sélectionner --</option>
        @for($i = 1; $i <= 5; $i++)
          <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
        @endfor
      </select>
      @error('rating')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Commentaire</label>
      <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:text-white border-gray-300"></textarea>
      @error('comment')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
      Soumettre mon avis
    </button>
  </form>
</div>
@endsection
