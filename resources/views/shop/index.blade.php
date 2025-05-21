@extends('layouts.app')

@section('content')
<!-- Section Bannière -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl font-bold">Découvrez Nos Meilleurs Produits</h1>
    <p class="mt-4 text-lg opacity-90">Trouvez le produit parfait pour vos besoins technologiques.</p>
  </div>
</div>

<!-- Section Carrousel -->
<div class="w-full max-w-6xl mx-auto py-16 px-4">
  <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-2xl h-[350px]">
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
    <!-- Boutons de navigation -->
    <div class="swiper-button-next text-white bg-blue-600 rounded-full w-10 h-10 flex items-center justify-center cursor-pointer z-10"></div>
    <div class="swiper-button-prev text-white bg-blue-600 rounded-full w-10 h-10 flex items-center justify-center cursor-pointer z-10"></div>
    <!-- Pagination -->
    <div class="swiper-pagination absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-10"></div>
  </div>
</div>

<!-- Section Produits -->
<section class="bg-gray-50 dark:bg-gray-900 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">Nos Produits</h2>

    <!-- Grille des produits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($products as $product)
        <a href="{{ route('shop.show', $product->id) }}" class="block group">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col h-full transition duration-300 transform hover:shadow-xl hover:-translate-y-1">
            @if ($product->image)
              <div class="relative h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center p-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain h-full w-full" />
              </div>
            @endif

            <div class="p-5 flex flex-col flex-grow">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white group-hover:text-blue-600 transition">{{ $product->name }}</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 flex-grow line-clamp-2">
                {{ Str::limit($product->description, 80) }}
              </p>

              <!-- Évaluation -->
              @php
                $average = round($product->averageRating(), 1);
                $rounded = round($average);
              @endphp
              <div class="flex items-center mt-3 text-yellow-400 text-sm">
                @for($i = 1; $i <= 5; $i++)
                  @if($i <= $rounded)
                    ★
                  @else
                    ☆
                  @endif
                @endfor
                <span class="text-gray-500 ml-2 text-xs">({{ $average }})</span>
              </div>

              <!-- Bouton -->
              <span class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-md transition duration-200">
                Voir Détails
              </span>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
      {{ $products->links('vendor.pagination.tailwind') }}
    </div>
  </div>
</section>

<!-- Script Swiper -->
<script>
  const swiper = new Swiper('.mySwiper', {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>

<!-- Tawk.to Chat -->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/682d7faa98a1b819123fb80f/1irorlcv2 ';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

@endsection
