@extends('layouts.app')

@section('content')

{{-- <!-- Bannière -->
<section class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-20">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-5xl font-extrabold tracking-tight">Découvrez Nos Meilleurs Produits</h1>
    <p class="mt-4 text-lg max-w-xl mx-auto opacity-90">Trouvez le produit parfait pour vos besoins technologiques.</p>
  </div>
</section> --}}

<!-- Carrousel -->
<section class="py-12">
  <div class="max-w-6xl mx-auto px-4">
    <div class="swiper mySwiper rounded-3xl overflow-hidden shadow-2xl h-[360px] relative">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="/images/slide1.png" alt="Slide 1" class="w-full h-full object-cover" />
        </div>
        <div class="swiper-slide">
          <img src="/images/slide2.jpg" alt="Slide 2" class="w-full h-full object-cover" />
        </div>
        <div class="swiper-slide">
          <img src="/images/slide3.jpg" alt="Slide 3" class="w-full h-full object-cover" />
        </div>
      </div>
      <div class="swiper-button-next bg-blue-700 hover:bg-blue-800 text-white rounded-full w-12 h-12 flex items-center justify-center absolute top-1/2 right-6 -translate-y-1/2 shadow-lg z-20"></div>
      <div class="swiper-button-prev bg-blue-700 hover:bg-blue-800 text-white rounded-full w-12 h-12 flex items-center justify-center absolute top-1/2 left-6 -translate-y-1/2 shadow-lg z-20"></div>
      <div class="swiper-pagination bottom-6 absolute left-0 right-0 flex justify-center z-20"></div>
    </div>
  </div>
</section>

@if(session('message'))
  <div class="max-w-7xl mx-auto px-4 mb-6 text-center text-green-600 font-semibold">
    {{ session('message') }}
  </div>
@endif

<!-- Section Produits avec Filtres -->
<section class="bg-gray-50 dark:bg-gray-900 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-12">Nos Produits</h2>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

      <!-- Filtres -->
      <aside
  class="lg:col-span-1 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 sticky top-20 h-fit"
>
  <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Filtres</h3>

  <!-- Bouton Catégorie avec dropdown -->
  <div class="relative mb-8">
  <button
    id="categoryDropdownButton"
    type="button"
    class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    aria-haspopup="true"
    aria-expanded="false"
  >
    Catégorie
    <svg
      class="ml-2 h-5 w-5 text-gray-500"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <div
    id="categoryDropdownMenu"
    class="origin-top-left absolute left-0 mt-2 w-full max-w-xs rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-20 overflow-auto max-h-60"
    role="menu"
    aria-labelledby="categoryDropdownButton"
  >
    <a
      href="{{ route('shop.index', request()->except('category')) }}"
      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ !request()->has('category') ? 'font-semibold' : '' }}"
      role="menuitem"
      >Toutes les catégories</a
    >

    @foreach($categories as $cat)
    <a
      href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => $cat->id])) }}"
      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request('category') == $cat->id ? 'font-semibold' : '' }}"
      role="menuitem"
    >
      {{ ucfirst($cat->name) }}
    </a>
    @endforeach
  </div>
</div>

<!-- Bouton Marque avec dropdown -->
<div class="relative mb-8">
  <button
    id="brandDropdownButton"
    type="button"
    class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    aria-haspopup="true"
    aria-expanded="false"
  >
    Marque
    <svg
      class="ml-2 h-5 w-5 text-gray-500"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <div
    id="brandDropdownMenu"
    class="origin-top-left absolute left-0 mt-2 w-full max-w-xs rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-20 overflow-auto max-h-60"
    role="menu"
    aria-labelledby="brandDropdownButton"
  >
    <a
      href="{{ route('shop.index', request()->except('brand')) }}"
      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ !request()->has('brand') ? 'font-semibold' : '' }}"
      role="menuitem"
      >Toutes les marques</a
    >

    @foreach($brands as $brand)
    <a
      href="{{ route('shop.index', array_merge(request()->except('brand'), ['brand' => $brand->id])) }}"
      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request('brand') == $brand->id ? 'font-semibold' : '' }}"
      role="menuitem"
    >
      {{ ucfirst($brand->name) }}
    </a>
    @endforeach
  </div>
</div>
  <!-- Prix -->
  <div class="mb-8">
    <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Prix (DH)</h4>
    <form method="GET" action="{{ route('shop.index') }}" id="price-filter-form">
      @foreach(request()->except(['min_price', 'max_price', 'page']) as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
      @endforeach

      <div class="flex flex-col gap-5">
        <div class="flex justify-between text-sm font-medium text-gray-600 dark:text-gray-400">
          <span id="min-price-display" class="select-none">{{ request('min_price', 0) }} DH</span>
          <span id="max-price-display" class="select-none">{{ request('max_price', 10000) }} DH</span>
        </div>
        <input
          type="range"
          min="0"
          max="10000"
          step="100"
          name="min_price"
          id="min-price"
          value="{{ request('min_price', 0) }}"
          class="w-full accent-blue-700 cursor-pointer"
        />
        <input
          type="range"
          min="0"
          max="10000"
          step="100"
          name="max_price"
          id="max-price"
          value="{{ request('max_price', 10000) }}"
          class="w-full accent-blue-700 cursor-pointer"
        />

        <button
          type="submit"
          class="self-end bg-blue-700 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-800 transition"
        >
          Appliquer
        </button>
      </div>
    </form>
  </div>

  <!-- Note -->
  <div class="relative mb-6">
    <button
      id="ratingDropdownButton"
      type="button"
      onclick="toggleCategoryDropdown('ratingDropdownMenu')"
      class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      aria-haspopup="true"
      aria-expanded="false"
    >
      Note
      <svg
        class="ml-2 h-5 w-5 text-gray-500"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <div
      id="ratingDropdownMenu"
      class="origin-top-left absolute left-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-20"
      role="menu"
      aria-labelledby="ratingDropdownButton"
    >
      <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="ratingDropdownButton">
        @for ($i = 4; $i >= 1; $i--)
        <a
          href="{{ route('shop.index', array_merge(request()->except('rating'), ['rating' => $i])) }}"
          class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request('rating') == $i ? 'font-semibold text-blue-700' : '' }}"
          role="menuitem"
        >
          <span class="mr-2">{{ $i }}★ et plus</span>
          <span class="flex text-yellow-400">
            @for ($star = 1; $star <= $i; $star++)
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 fill-current"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.287 3.97c.3.92-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.785.57-1.838-.197-1.539-1.118l1.287-3.97a1 1 0 00-.364-1.118L2.045 9.397c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.97z"
              />
            </svg>
            @endfor
          </span>
        </a>
        @endfor
      </div>
    </div>
  </div>

  <!-- Bouton Réinitialiser -->
  <a
    href="{{ route('shop.index') }}"
    class="block text-center mt-8 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition"
  >
    Réinitialiser tous les filtres
  </a>
</aside>


</aside>

      <!-- Produits -->
      <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse ($products as $product)
          <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700 flex flex-col overflow-hidden">
            @if ($product->image)
              <div class="relative h-52 bg-gray-100 dark:bg-gray-700 p-5 flex items-center justify-center">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full object-contain" />
              </div>
            @endif
            <div class="p-6 flex flex-col flex-grow">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
              <p class="text-blue-600 font-bold text-2xl mt-2">{{ number_format($product->price, 2, ',', ' ') }} DH</p>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-3 flex-grow line-clamp-3">{{ Str::limit($product->description, 100) }}</p>

              @php $average = $product->reviews->avg('rating'); @endphp
              <div class="mt-4 flex items-center text-yellow-400">
                @for ($i = 1; $i <= 5; $i++)
                  <i class="{{ $i <= round($average) ? 'fas fa-star' : 'far fa-star' }}"></i>
                @endfor
                <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                  ({{ number_format($average, 1) }}/5 basé sur {{ $product->reviews->count() }} avis)
                </span>
              </div>

              <div class="mt-6 flex gap-4">
                <a href="{{ route('shop.show', $product->id) }}" class="flex-1 text-center bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-xl font-semibold transition">
                  Voir Détails
                </a>
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="flex-1">
                  @csrf
                  <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                    Wishlist
                  </button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <p class="text-gray-600 dark:text-gray-400 col-span-full text-center text-lg">Aucun produit trouvé.</p>
        @endforelse
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-14 flex justify-center">
      {{ $products->links('vendor.pagination.tailwind') }}
    </div>
  </div>
</section>

<!-- Swiper.js -->
<!-- Swiper -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiper', {
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      }
    });
  });
</script>

<!-- Script filtre prix -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const minDisplay = document.getElementById('min-price-display');
    const maxDisplay = document.getElementById('max-price-display');

    function updateDisplay() {
      let minVal = parseInt(minPrice.value);
      let maxVal = parseInt(maxPrice.value);

      if (minVal > maxVal) {
        maxPrice.value = minVal;
        maxVal = minVal;
      }

      minDisplay.textContent = minPrice.value + ' DH';
      maxDisplay.textContent = maxPrice.value + ' DH';
    }

    if (minPrice && maxPrice && minDisplay && maxDisplay) {
      minPrice.addEventListener('input', updateDisplay);
      maxPrice.addEventListener('input', updateDisplay);
      updateDisplay();
    }
  });
</script>

<!-- Script dropdown filtres -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const categoryButton = document.getElementById('categoryDropdownButton');
    const categoryMenu = document.getElementById('categoryDropdownMenu');
    const brandButton = document.getElementById('brandDropdownButton');
    const brandMenu = document.getElementById('brandDropdownMenu');

    // Ouvre/ferme menu catégorie et ferme menu marque si ouvert
    if (categoryButton && categoryMenu) {
      categoryButton.addEventListener('click', function (e) {
        e.stopPropagation();
        categoryMenu.classList.toggle('hidden');
        if (brandMenu && !brandMenu.classList.contains('hidden')) {
          brandMenu.classList.add('hidden');
        }
      });
    }

    // Ouvre/ferme menu marque et ferme menu catégorie si ouvert
    if (brandButton && brandMenu) {
      brandButton.addEventListener('click', function (e) {
        e.stopPropagation();
        brandMenu.classList.toggle('hidden');
        if (categoryMenu && !categoryMenu.classList.contains('hidden')) {
          categoryMenu.classList.add('hidden');
        }
      });
    }

    // Ferme les menus si clic hors des boutons ou menus
    document.addEventListener('click', function (event) {
      if (
        categoryMenu && !categoryMenu.classList.contains('hidden') &&
        categoryButton && !categoryButton.contains(event.target) &&
        !categoryMenu.contains(event.target)
      ) {
        categoryMenu.classList.add('hidden');
      }

      if (
        brandMenu && !brandMenu.classList.contains('hidden') &&
        brandButton && !brandButton.contains(event.target) &&
        !brandMenu.contains(event.target)
      ) {
        brandMenu.classList.add('hidden');
      }
    });
  });
</script>


<!-- Tawk.to Chat -->
<script type="text/javascript">
  var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
  (function () {
    var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/682d7faa98a1b819123fb80f/1irorlcv2';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
<script>
  function toggleCategoryDropdown(menuId) {
    const menu = document.getElementById(menuId);
    if (!menu) return;

    // Fermer tous les menus dropdown
    document.querySelectorAll('div[id$="DropdownMenu"]').forEach(m => {
      if (m.id !== menuId) m.classList.add('hidden');
    });

    // Toggle celui cliqué
    menu.classList.toggle('hidden');
  }

  // Cacher dropdown quand clic en dehors
  document.addEventListener('click', (e) => {
    const dropdownMenus = document.querySelectorAll('div[id$="DropdownMenu"]');
    const isDropdownButton = e.target.closest('button[id$="DropdownButton"]');

    if (!isDropdownButton) {
      dropdownMenus.forEach(menu => menu.classList.add('hidden'));
    }
  });

  // Synchronisation sliders prix pour que min <= max
  const minPriceInput = document.getElementById('min-price');
  const maxPriceInput = document.getElementById('max-price');
  const minPriceDisplay = document.getElementById('min-price-display');
  const maxPriceDisplay = document.getElementById('max-price-display');

  if (minPriceInput && maxPriceInput) {
    minPriceInput.addEventListener('input', () => {
      let minVal = parseInt(minPriceInput.value);
      let maxVal = parseInt(maxPriceInput.value);
      if (minVal > maxVal) {
        maxPriceInput.value = minVal;
        maxPriceDisplay.textContent = maxPriceInput.value + " DH";
      }
      minPriceDisplay.textContent = minPriceInput.value + " DH";
    });

    maxPriceInput.addEventListener('input', () => {
      let minVal = parseInt(minPriceInput.value);
      let maxVal = parseInt(maxPriceInput.value);
      if (maxVal < minVal) {
        minPriceInput.value = maxVal;
        minPriceDisplay.textContent = minPriceInput.value + " DH";
      }
      maxPriceDisplay.textContent = maxPriceInput.value + " DH";
    });
  }
</script>





@endsection
