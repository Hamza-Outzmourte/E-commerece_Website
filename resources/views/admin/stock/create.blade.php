@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Ajouter un nouveau stock</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stock.store') }}" method="POST">
        @csrf

        <label class="block mb-2 font-semibold" for="product_id">Produit</label>
        <select name="product_id" id="product_id" class="w-full border rounded px-3 py-2 mb-4" required>
            <option value="">-- Sélectionnez un produit --</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>

        <label class="block mb-2 font-semibold" for="quantity">Quantité</label>
        <input type="number" name="quantity" id="quantity" class="w-full border rounded px-3 py-2 mb-4" min="0" value="{{ old('quantity') }}" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</button>
    </form>
</div>
@endsection
