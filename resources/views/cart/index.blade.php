@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-white">Panier</h1>

    @if(session('success'))
        <div
          class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded shadow-sm dark:bg-green-900 dark:text-green-300 dark:border-green-700"
          role="alert"
        >
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-gray-100 rounded-lg shadow">
        <table class="min-w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Produit</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Prix Unitaire</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Quantité</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $product)
                @php $total += $product['price'] * $product['quantity']; @endphp
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium whitespace-nowrap">{{ $product['name'] }}</td>
                    <td class="px-6 py-4">
                        @if ($product['image'])
                            <img
                              src="{{ asset('storage/' . $product['image']) }}"
                              alt="{{ $product['name'] }}"
                              class="w-16 h-16 object-cover rounded-md border border-gray-300 dark:border-gray-600"
                            >
                        @else
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs">
                              Pas d'image
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ number_format($product['price'], 2) }} Dh</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input
                              type="number"
                              name="quantity"
                              value="{{ $product['quantity'] }}"
                              min="1"
                              class="w-20 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                            >
                            <button
                              type="submit"
                              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-md text-sm transition"
                            >
                              Modifier
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-semibold">
                      {{ number_format($product['price'] * $product['quantity'], 2) }} Dh
                    </td>
                    <td class="px-6 py-4">
                        <form
                          action="{{ route('cart.remove', $id) }}"
                          method="POST"
                          onsubmit="return confirm('Supprimer ce produit ?')"
                        >
                            @csrf
                            <button
                              type="submit"
                              class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-md text-sm transition"
                            >
                              Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Total Panier : <span class="text-blue-600">{{ number_format($total, 2) }} Dh</span>
        </h3>
        <a
          href="{{ route('checkout.index') }}"
          class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-semibold shadow transition"
        >
          Passer à la commande
        </a>
    </div>
    @else
    <p class="text-gray-600 dark:text-gray-400 text-center mt-20 text-lg">
      Votre panier est vide.
    </p>
    @endif
</div>
@endsection
