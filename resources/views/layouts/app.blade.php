<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Swiper CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dark:bg-gray-900 text-gray-900 dark:text-white">

    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow fixed w-full z-50 h-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/22.png') }}" alt="Logo" class="h-12 w-auto">
        </a>

        <!-- Search bar -->
        <div class="hidden md:flex items-center flex-1 justify-center px-4">
            <form action="{{ route('search') }}" method="GET" class="relative w-full max-w-md">
                <input type="text" name="query" placeholder="Rechercher..."
                    class="w-full py-2 pl-4 pr-10 rounded-md border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition duration-200">
                <button type="submit"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    🔍
                </button>
            </form>
        </div>

        <!-- User actions -->
        <div class="flex items-center space-x-4 text-sm">

            <!-- Panier -->
            <a href="{{ route('cart.index') }}" class="relative text-white hover:text-blue-400 text-xl">
                🛒
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs px-1">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

            @auth
    <div x-data="{ open: false }" class="relative text-gray-800 dark:text-white">
        <button @click="open = !open" class="text-xl hover:text-pink-500">
            <i class="fa-regular fa-user"></i>
        </button>

        <!-- Menu déroulant -->
        <div x-show="open" @click.away="open = false"
             x-transition
             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 text-gray-700 text-sm">
            <ul class="py-2">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Tableau de bord</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Commandes</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Adresses</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Détails du compte</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                            Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endauth



            @guest

                <a href="{{ route('login') }}">

                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                <a href="{{ route('register') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition">
                    Inscription
                </a>
            @endguest
        </div>
    </div>
</header>

    <div class="w-full max-w-6xl mx-auto py-8 pt-20 h-[400px]">
  <div class="swiper mySwiper rounded-md overflow-hidden shadow-lg h-[350px]">
    <div class="swiper-wrapper">
      <!-- Slide 1 -->
      <div class="swiper-slide">
        <img src="/images/slide1.png" alt="Slide 1" class="w-full h-350 object-cover" />
      </div>
      <!-- Slide 2 -->
      <div class="swiper-slide">
        <img src="/images/slide2.jpg" alt="Slide 2" class="w-full h-350 object-cover" />
      </div>
      <!-- Slide 3 -->
      <div class="swiper-slide">
        <img src="/images/slide3.jpg" alt="Slide 3" class="w-full h-350 object-cover" />
      </div>
    </div>

    <!-- Navigation (optional) -->
    <div class="swiper-button-next text-pink-600"></div>
    <div class="swiper-button-prev text-pink-600"></div>
    <div class="swiper-pagination"></div>
  </div>
</div>

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


<footer class="bg-gray-100 text-gray-700 text-sm pt-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- La grille limitée en largeur et centrée -->
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 text-left">

      <!-- Colonne 1 -->
      <div class="min-w-0 ">
        <img src="/images/4.png" alt="MaxGaming Logo" class="h-22 mb-4">
        <p class="mb-2 max-w-xs">
          MaxGaming Maroc - Votre partenaire de confiance pour des produits gaming de qualité: pc gamer, pc portable, Souris, Clavier, Moniteur...
        </p>
        <p>Local commercial N°23 de l'immeuble T3 résidence Marmar 2, Sidi Alqédia</p>
        <p class="mt-2">Tél: 06 59 37 01 37</p>
        <p>Tél: 06 38 08 07 67</p>
        <p>
          Email:
          <a href="mailto:contact@maxgaming.ma" class="text-pink-600 hover:underline">contact@maxgaming.ma</a>
        </p>

        <div class="flex space-x-6">
  <i class="fa-brands fa-whatsapp text-2xl text-gray-600 cursor-pointer
            rounded-full p-3
            transition duration-300
            hover:bg-red-600 hover:text-white hover:scale-110"></i>

  <i class="fa-brands fa-instagram text-2xl text-gray-600 cursor-pointer
            rounded-full p-2
            transition duration-300
            hover:bg-red-600 hover:text-white hover:scale-110"></i>

  <i class="fa-brands fa-facebook text-2xl text-gray-600 cursor-pointer
            rounded-full p-3
            transition duration-300
            hover:bg-red-600 hover:text-white hover:scale-110"></i>

  <i class="fa-brands fa-youtube text-2xl text-gray-600 cursor-pointer
            rounded-full p-3
            transition duration-300
            hover:bg-red-600 hover:text-white hover:scale-110"></i>
</div>
        </div>

      <!-- Colonnes 2 à 5 -->
      <div class="min-w-0">
        <h3 class="font-semibold mb-2">LIENS UTILES</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Demande de retour</a></li>
          <li><a href="#" class="hover:underline">Pour les professionnels</a></li>
          <li><a href="#" class="hover:underline">Magasin</a></li>
          <li><a href="#" class="hover:underline">Blog</a></li>
          <li><a href="#" class="hover:underline">Nouveautés</a></li>
        </ul>
      </div>

      <div class="min-w-0">
        <h3 class="font-semibold mb-2">PRODUITS POPULAIRES</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Ordinateurs portables</a></li>
          <li><a href="#" class="hover:underline">MaxPC</a></li>
          <li><a href="#" class="hover:underline">Moniteurs</a></li>
          <li><a href="#" class="hover:underline">CONFIGURER VOTRE PC</a></li>
          <li><a href="#" class="hover:underline">Cartes graphiques</a></li>
        </ul>
      </div>

      <div class="min-w-0">
        <h3 class="font-semibold mb-2">À PROPOS</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Qui sommes-nous</a></li>
          <li><a href="#" class="hover:underline">Conditions générales</a></li>
          <li><a href="#" class="hover:underline">Politique de Confidentialité</a></li>
          <li><a href="#" class="hover:underline">Contactez-nous</a></li>
        </ul>
      </div>

      <div class="min-w-0">
        <!-- Colonne vide -->
      </div>
    </div>

    <div class="mt-10 border-t pt-4 text-center text-xs text-gray-500">
      <p>Copyright 2025 MaxGaming Powered by Gaming Distro | Tous les droits sont réservés.</p>
      <p>Une réalisation de <a href="#" class="text-pink-600 hover:underline">Naykomedia</a></p>
    </div>
  </div>
</footer>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>
<script>
  const swiper = new Swiper('.mySwiper', {
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
  });
</script>

</body>
</html>
