@extends('layouts.app') {{-- Si tu utilises un layout de base --}}

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Bonjour, {{ $user->name }}</h1>

    {{-- Résumé rapide --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 dark:text-gray-400">Commandes</span>
                <i class="fas fa-shopping-bag text-indigo-600 text-xl"></i>
            </div>
            <p class="text-2xl font-semibold text-gray-800 dark:text-white mt-2">{{ $orderCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 dark:text-gray-400">Notifications</span>
                <i class="fas fa-bell text-yellow-500 text-xl"></i>
            </div>
            <p class="text-2xl font-semibold mt-2 text-gray-800 dark:text-white">{{ $unreadNotificationsCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 dark:text-gray-400">Points</span>
                <i class="fas fa-coins text-green-500 text-xl"></i>
            </div>
            <p class="text-2xl font-semibold mt-2 text-gray-800 dark:text-white">{{ $points }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 dark:text-gray-400">Total Dépensé</span>
                <span class="text-pink-500 font-semibold text-sm">DH</span>

            </div>
            <p class="text-2xl font-semibold mt-2 text-gray-800 dark:text-white">{{ number_format($totalSpent, 2) }} DH</p>
        </div>
    </div>

    {{-- Commandes récentes --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Commandes récentes</h2>
        @if($recentOrders->isEmpty())
            <p class="text-gray-500">Aucune commande pour le moment.</p>
        @else
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($recentOrders as $order)
                    <li class="py-3 flex justify-between">
                        <span>#{{ $order->id }} - {{ $order->created_at->format('d/m/Y') }}</span>
                        <span class="text-sm text-white px-2 py-1 rounded bg-{{ $order->status === 'completed' ? 'green' : 'yellow' }}-500">
                            {{ ucfirst($order->status) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Produits recommandés --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Produits recommandés</h2>
        @if($recommendedProducts->isEmpty())
            <p class="text-gray-500">Aucune recommandation pour le moment.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                @foreach($recommendedProducts as $product)
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded shadow-sm">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-28 object-cover rounded">
                        <h3 class="text-sm font-medium mt-2 text-gray-700 dark:text-white">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500">{{ number_format($product->price, 2) }} €</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Statistiques perso --}}
    <div class="grid md:grid-cols-2 gap-6 mb-10">
        {{-- Produits les plus achetés --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Produits les plus achetés</h2>
            @if($topProducts->isEmpty())
                <p class="text-gray-500">Aucun produit acheté.</p>
            @else
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($topProducts as $item)
                        <li class="py-2 flex justify-between">
                            <span>{{ $item->product->name ?? 'Produit supprimé' }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">x{{ $item->count }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Produits récemment vus --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Produits récemment consultés</h2>
            @if($recentViewedProducts->isEmpty())
                <p class="text-gray-500">Aucune consultation récente.</p>
            @else
                <div class="grid grid-cols-3 gap-3">
                    @foreach($recentViewedProducts as $product)
                        <div class="text-center">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-16 w-full object-cover rounded mb-1">
                            <p class="text-xs text-gray-700 dark:text-gray-200">{{ $product->name }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Wishlist --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Ma wishlist</h2>
        @if($wishlist->isEmpty())
            <p class="text-gray-500">Votre liste de souhaits est vide.</p>
        @else
            <div class="flex flex-wrap gap-4">
                @foreach($wishlist as $item)
                    <div class="w-32 text-center">
                        <img
        src="{{ asset('storage/' . $item->product->image) }}"
        alt="{{ $item->product->name }}"
        class="w-full h-full object-cover rounded"
      >
                        <p class="text-sm mt-1 text-gray-700 dark:text-gray-200">{{ $item->product->name }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Support Tickets & Retours --}}
    <div class="grid md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Mes tickets support</h2>
            @forelse($supportTickets as $ticket)
                <div class="mb-2">
                    <p class="text-sm text-gray-700 dark:text-gray-200 font-medium">#{{ $ticket->id }} - {{ $ticket->subject }}</p>
                    <p class="text-xs text-gray-500">{{ $ticket->created_at->format('d/m/Y') }}</p>
                </div>
            @empty
                <p class="text-gray-500">Aucun ticket ouvert.</p>
            @endforelse
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Demandes de retour</h2>
            @forelse($returnRequests as $retour)
                <p class="text-sm text-gray-700 dark:text-gray-200 mb-2">
                    Retour #{{ $retour->id }} - {{ ucfirst($retour->status) }}
                </p>
            @empty
                <p class="text-gray-500">Aucune demande en cours.</p>
            @endforelse
        </div>
    </div>

    {{-- Avis --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Mes derniers avis</h2>
        @forelse($reviews as $review)
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $review->product->name ?? 'Produit supprimé' }}</p>
                <p class="text-sm text-gray-500 italic">"{{ $review->comment }}"</p>
            </div>
        @empty
            <p class="text-gray-500">Aucun avis publié.</p>
        @endforelse
    </div>
</div>
@endsection
