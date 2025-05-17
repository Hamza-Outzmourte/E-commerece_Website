@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Panier</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Produit</th>
                    <th class="px-4 py-2 text-left">Image</th>
                    <th class="px-4 py-2 text-left">Prix Unitaire</th>
                    <th class="px-4 py-2 text-left">Quantité</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $product)
                @php $total += $product['price'] * $product['quantity']; @endphp
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $product['name'] }}</td>
                    <td class="px-4 py-2">
                        @if ($product['image'])
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-16 h-16 object-cover rounded">
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ number_format($product['price'], 2) }} Dh</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" class="w-16 px-2 py-1 border rounded">
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Modifier</button>
                        </form>
                    </td>
                    <td class="px-4 py-2">{{ number_format($product['price'] * $product['quantity'], 2) }} Dh</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-between items-center">
        <h3 class="text-xl font-semibold">Total Panier : {{ number_format($total, 2) }} Dh</h3>
        <a href="{{ route('checkout.index') }}" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
    Passer à la commande
</a>

    </div>
    @else
    <p class="text-gray-600">Votre panier est vide.</p>
    @endif
</div>
@endsection

