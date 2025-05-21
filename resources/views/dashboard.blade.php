@extends('layouts.app')

@section('header')
Tableau de bord
@endsection

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg space-y-8">

  <!-- Message de bienvenue -->
  <div class="text-center md:text-left">
    <h1 class="text-3xl font-extrabold mb-2 text-gray-800 dark:text-white">Bienvenue, {{ $user->name }} 👋</h1>
    <p class="text-gray-600 dark:text-gray-400">Voici un aperçu de votre activité récente.</p>
  </div>

  <!-- Statistiques en grille -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Commandes -->
    <div class="p-6 bg-blue-50 dark:bg-blue-800/30 rounded-xl shadow hover:shadow-md transition duration-300 border border-blue-100 dark:border-blue-700">
      <h2 class="text-lg font-semibold mb-2 text-blue-700 dark:text-blue-300">Vos commandes</h2>
      <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $orderCount }}</p>
      <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">commandes en cours</p>
      <a href="{{ route('orders.index') }}" class="mt-3 inline-block text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">Voir mes commandes →</a>
    </div>

    <!-- Notifications -->
    <div class="p-6 bg-green-50 dark:bg-green-800/30 rounded-xl shadow hover:shadow-md transition duration-300 border border-green-100 dark:border-green-700">
      <h2 class="text-lg font-semibold mb-2 text-green-700 dark:text-green-300">Notifications</h2>
      @if(auth()->user()->notifications->count())
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->unreadNotifications->count() }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">non lues</p>
        <a href="{{ route('notifications.index') }}" class="mt-3 inline-block text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium">Voir mes notifications →</a>
      @else
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Aucune notification non lue.</p>
        <a href="{{ route('notifications.index') }}" class="mt-3 inline-block text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium">Consulter toutes les notifications →</a>
      @endif
    </div>

    <!-- Profil -->
    <div class="p-6 bg-yellow-50 dark:bg-yellow-800/30 rounded-xl shadow hover:shadow-md transition duration-300 border border-yellow-100 dark:border-yellow-700">
      <h2 class="text-lg font-semibold mb-2 text-yellow-700 dark:text-yellow-300">Profil</h2>
      <p class="text-gray-800 dark:text-gray-200">Nom : <strong>{{ $user->name }}</strong></p>
      <p class="text-gray-800 dark:text-gray-200">Email : <strong>{{ $user->email }}</strong></p>
      <a href="{{ route('profile.edit') }}" class="mt-3 inline-block text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300 font-medium">Modifier mes informations →</a>
    </div>
  </div>

  <!-- Section boutique -->
  <div class="p-6 bg-purple-50 dark:bg-purple-900/30 rounded-xl shadow hover:shadow-lg transition duration-300 border border-purple-100 dark:border-purple-700">
    <h2 class="text-xl font-semibold mb-3 text-purple-700 dark:text-purple-300">Découvrez la boutique</h2>
    <p class="mb-4 text-gray-700 dark:text-gray-300">Parcourez les derniers produits et profitez des meilleures offres.</p>
    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-5 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
      Voir la boutique
      <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </a>
  </div>

  <!-- Recommandations -->
  <div class="p-6 bg-gray-50 dark:bg-gray-800/50 rounded-xl shadow hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Recommandations</h2>
    <ul class="space-y-3 text-gray-700 dark:text-gray-300">
      <li class="flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        Produit A - Super performance pour le gaming
      </li>
      <li class="flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        Produit B - Idéal pour la productivité
      </li>
      <li class="flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        Produit C - Offre spéciale cette semaine
      </li>
    </ul>
  </div>

</div>
@endsection
