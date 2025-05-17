@extends('layouts.app')

@section('header')
    Tableau de bord
@endsection

@section('content')
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Bienvenue {{ $user->name }} 👋</h1>

        <p class="text-gray-600 dark:text-gray-300">Vous êtes connecté. Voici votre tableau de bord.</p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded shadow">
                <h2 class="text-lg font-semibold">Produits</h2>
                <p>Vous avez <strong>{{ $productCount }}</strong> produits enregistrés.</p>
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">Voir les produits</a>
            </div>
            <div class="p-4 bg-green-100 dark:bg-green-900 rounded shadow">
                <h2 class="text-lg font-semibold">Commandes</h2>
                <p>Vous avez <strong>{{ $orderCount }}</strong> commandes.</p>
                <a href="{{ route('orders.index') }}" class="text-green-600 hover:underline">Voir les commandes</a>
            </div>
            <div class="p-4 bg-yellow-100 dark:bg-yellow-900 rounded shadow">
                <h2 class="text-lg font-semibold">Paramètres</h2>
                <p>Gérez vos informations personnelles.</p>
                <a href="{{ route('profile.edit') }}" class="text-yellow-600 hover:underline">Modifier mon profil</a>
            </div>
        </div>
    </div>
@endsection
