@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-6">Résultats pour "{{ $query }}"</h2>

    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition duration-200 flex flex-col">

                    <!-- Image -->
                    <a href="{{ route('shop.show', $product->id) }}" class="block overflow-hidden rounded-t-xl">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="h-48 w-full object-contain bg-gray-50 p-4">
                    </a>

                    <!-- Contenu -->
                    <div class="p-4 flex flex-col flex-grow justify-between">

                        <!-- Nom -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">
                            {{ $product->name }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-3 mb-2">
                            {{ $product->description }}
                        </p>

                        <!-- En stock -->
                        <p class="text-sm font-medium mb-2">
    @if($product->stock > 0)
        <span class="text-green-600">En stock</span>
    @else
        <span class="text-red-500">Rupture de stock</span>
    @endif
</p>


                        <!-- Prix -->
                        <p class="text-xl font-semibold text-yellow-600 mb-4">
                            {{ number_format($product->price, 2) }} Dh
                        </p>

                        <!-- Boutons -->
                        <div class="flex flex-col gap-2 mt-auto">
                            

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-black py-2 rounded-md text-sm font-semibold">
                                    Ajouter au panier 🛒
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->appends(request()->input())->links() }}
        </div>
    @else
        <p class="text-gray-500">Aucun produit trouvé.</p>
    @endif
</div>
@endsection
