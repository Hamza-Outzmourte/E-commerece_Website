{{-- resources/views/wishlist/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Ma Wishlist')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Ma Wishlist</h1>

    @if ($wishlistItems->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">Votre wishlist est vide.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($wishlistItems as $item)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-4 flex flex-col">
                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('images/default-product.png') }}" alt="{{ $item->product->name }}" class="h-48 w-full object-cover rounded-md mb-4">


                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h2>
                    <p class="text-green-600 font-bold text-lg mt-2">{{ number_format($item->product->price, 2, ',', ' ') }} MAD</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($item->product->description, 80) }}</p>

                    <div class="mt-auto flex justify-between items-center pt-4">
                        <a href="{{ route('shop.show', $item->product->id) }}" class="text-purple-600 hover:text-purple-800 font-medium">Voir le produit</a>

                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer ce produit de votre wishlist ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
