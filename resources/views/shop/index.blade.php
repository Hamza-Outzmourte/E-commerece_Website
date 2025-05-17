@extends('layouts.app')

@section('content')
<div class="bg-white py-16" style="overflow: visible;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="overflow: visible;">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Nos Produits</h1>

    <!-- Grille responsive -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" style="overflow: visible;">
      @foreach ($products as $product)
      <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition duration-300 border border-gray-200">
        @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
          class="w-full h-48 object-contain rounded-t-2xl bg-white" />
        @endif
        <div class="p-4">
          <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
          <p class="text-sm text-gray-600">{{ Str::limit($product->description, 50) }}</p>
          <p class="text-lg font-bold text-green-600 mt-2">{{ number_format($product->price, 2) }} Dh</p>
          <a href="{{ route('shop.show', $product->id) }}"
             class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm transition duration-200">
            Voir Détails
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10">
      {{ $products->links() }}
    </div>
  </div>
</div>
@endsection
