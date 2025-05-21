<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/star-rating.js/dist/star-rating.css">





    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
<header class="bg-white dark:bg-gray-900 shadow-md fixed w-full z-50 transition duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
      <img src="{{ asset('images/22.png') }}" alt="Logo" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
      <span class="text-lg font-semibold text-gray-800 dark:text-white hidden sm:inline group-hover:text-indigo-600">Ma Boutique</span>
    </a>

    <!-- Search Bar -->
    <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center w-full max-w-xl mx-4 rounded-md overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 focus-within:ring-2 focus-within:ring-indigo-500">
      <input type="text" name="q" placeholder="Rechercher un produit..." class="w-full px-4 py-2 bg-white dark:bg-gray-800 border-none text-sm text-gray-800 dark:text-white focus:outline-none placeholder-gray-400" required>
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 flex items-center justify-center transition duration-200" aria-label="Rechercher">
        <i class="fas fa-search"></i>
      </button>
    </form>

    <!-- Actions utilisateur -->
    <div class="flex items-center space-x-5 text-gray-700 dark:text-gray-200">
      <!-- Panier -->
      <a href="{{ route('cart.index') }}" class="relative hover:text-yellow-500 transition-colors duration-200">
        <i class="fas fa-shopping-cart text-xl"></i>
        @if(session('cart') && count(session('cart')) > 0)
          <span class="absolute -top-2 -right-2.5 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
            {{ count(session('cart')) }}
          </span>
        @endif
      </a>

      <!-- Notifications -->
      <a href="{{ route('notifications.index') }}" class="relative hover:text-blue-500 transition-colors duration-200">
        <i class="fa-regular fa-bell text-xl"></i>
        @php $unread = auth()->user()?->unreadNotifications->count() ?? 0; @endphp
        @if($unread > 0)
          <span class="absolute -top-2 -right-2.5 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
            {{ $unread }}
          </span>
        @endif
      </a>

      <!-- Profil Dropdown -->
      @auth
        <div x-data="{ open: false }" class="relative">
          <button @click="open = !open" class="hover:text-pink-500 transition-colors duration-200">
            <i class="fa-regular fa-user text-xl"></i>
          </button>
          <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-lg z-50 text-sm text-gray-800 dark:text-gray-200">
            <ul class="py-2">
              <li><a href="{{ url('/dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Tableau de bord</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Commandes</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Adresses</a></li>
              <li><a href="{{ url('/profile') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Profil</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Déconnexion
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="hover:text-pink-500 transition-colors duration-200">
          <i class="fa-regular fa-user text-xl"></i>
        </a>
      @endauth
    </div>
  </div>
</header>







    <!-- Page Content -->
    <div class="flex pt-16 min-h-screen">
        <main class="flex-1 p-6   dark:bg-gray-900">
            @if (View::hasSection('header'))
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6 px-6 py-4">
                    @yield('header')
                </div>
            @endif

            <!-- <div class="bg-white dark:bg-gray-800 shadow rounded-lg px-6 py-6"> -->
                @yield('content')
            <!-- </div> -->
        </main>
    </div>
    <!-- Footer container -->
    <div class="bg-white border-t border-b border-gray-200 py-10 text-base text-gray-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

    <div class="flex items-center space-x-6">
      <img src="/images/5.jpg" alt="Livraison Express" class="h-16 w-16 object-contain">
      <div>
        <p class="font-semibold text-lg">Livraison Express</p>
        <p>Partout au Maroc</p>
      </div>
    </div>

    <div class="flex items-center space-x-6">
      <img src="/images/6.jpg" alt="Satisfaction Garantie" class="h-16 w-16 object-contain">
      <div>
        <p class="font-semibold text-lg">Satisfaction Garantie</p>
        <p>Entière satisfaction assurée</p>
      </div>
    </div>

    <div class="flex items-center space-x-6">
      <img src="/images/7.jpg" alt="Garantie Produits" class="h-16 w-16 object-contain">
      <div>
        <p class="font-semibold text-lg">Garantie Produits</p>
        <p>Garantie minimale : 12 mois</p>
      </div>
    </div>

    <div class="flex items-center space-x-6">
      <img src="/images/8.jpg" alt="Support Client" class="h-16 w-16 object-contain">
      <div>
        <p class="font-semibold text-lg">Support Client</p>
        <p>À votre service</p>
      </div>
    </div>

  </div>
</div>


<footer class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 pt-12 pb-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
      <!-- Colonne 1 - À propos -->
      <div>
        <img src="/images/4.png" alt="MaxGaming Logo" class="h-12 mb-4">
        <p class="mb-4 text-sm">
          Votre boutique en ligne spécialisée dans les équipements gaming et high-tech.
        </p>
        <p class="text-sm">Adresse : Local commercial N°23 résidence Marmar 2, Sidi Alqédia</p>
        <p class="text-sm mt-1">Tél: 06 59 37 01 37 | 06 38 08 07 67</p>
        <p class="text-sm mt-1">Email: <a href="mailto:contact@maxgaming.ma" class="hover:underline">contact@maxgaming.ma</a></p>
        <div class="flex space-x-4 mt-4">
          <a href="#" class="text-gray-600 hover:text-red-600 transition"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-gray-600 hover:text-red-600 transition"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-gray-600 hover:text-red-600 transition"><i class="fab fa-youtube"></i></a>
          <a href="#" class="text-gray-600 hover:text-red-600 transition"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>

      <!-- Colonnes utiles -->
      <div>
        <h3 class="font-semibold text-base mb-3">LIENS UTILES</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Demande de retour</a></li>
          <li><a href="#" class="hover:underline">Pour les professionnels</a></li>
          <li><a href="#" class="hover:underline">Magasin</a></li>
          <li><a href="#" class="hover:underline">Blog</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-semibold text-base mb-3">PRODUITS POPULAIRES</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Ordinateurs portables</a></li>
          <li><a href="#" class="hover:underline">Moniteurs</a></li>
          <li><a href="#" class="hover:underline">Cartes graphiques</a></li>
          <li><a href="#" class="hover:underline">CONFIGURER VOTRE PC</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-semibold text-base mb-3">À PROPOS</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Qui sommes-nous</a></li>
          <li><a href="#" class="hover:underline">Conditions générales</a></li>
          <li><a href="#" class="hover:underline">Politique de Confidentialité</a></li>
          <li><a href="{{ route('contact.show') }}" class="hover:underline">Contactez-nous</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-semibold text-base mb-3">SUIVEZ-NOUS</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Facebook</a></li>
          <li><a href="#" class="hover:underline">Instagram</a></li>
          <li><a href="#" class="hover:underline">YouTube</a></li>
          <li><a href="#" class="hover:underline">WhatsApp</a></li>
        </ul>
      </div>
    </div>

    <div class="mt-10 pt-6 border-t border-gray-300 dark:border-gray-700 text-center text-xs text-gray-500">
      <p>© 2025 MaxGaming - Tous droits réservés.</p>
      <p>Réalisé par <a href="#" class="text-indigo-600 hover:underline">Naykomedia</a></p>
    </div>
  </div>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/star-rating.js/dist/star-rating.min.js"></script>
</body>
</html>
