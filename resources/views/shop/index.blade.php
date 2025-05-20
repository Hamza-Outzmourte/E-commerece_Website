@extends('layouts.app')

@section('content')
<div class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Nos Produits</h1>

    <!-- Grille responsive -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($products as $product)
        <a href="{{ route('shop.show', $product->id) }}" class="block h-full">
  <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden flex flex-col h-full transform hover:scale-105 transition duration-300">

    @if ($product->image)
      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
        class="w-full h-48 object-contain bg-white" />
    @endif

    <div class="p-4 flex flex-col flex-grow">
      <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
      <p class="text-sm text-gray-600 flex-grow">{{ Str::limit($product->description, 50) }}</p>

      <span class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm transition duration-200">
        Voir Détails
      </span>
    </div>

  </div>
</a>

      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10">
      {{ $products->links() }}
    </div>
  </div>
</div>
@endsection
