@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Finaliser votre commande</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nom complet</label>
            <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" name="address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Mode de paiement</label>
            <select name="payment_method" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                <option value="cod">Paiement à la livraison</option>
                <option value="card">Carte bancaire</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Valider la commande
        </button>
    </form>
</div>
@endsection
