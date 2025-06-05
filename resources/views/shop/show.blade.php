@extends('layouts.app')

@section('title', $product->name . ' | Détails du produit')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <!-- Produit -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white p-8 rounded-3xl shadow-lg">

    <!-- Galerie Swiper -->
    <div class="space-y-6">
      <div class="swiper mySwiper rounded-xl overflow-hidden shadow-lg border border-gray-200">
        <div class="swiper-wrapper">
          <!-- Image principale -->
          <div class="swiper-slide relative group">
            <img
              src="{{ asset('storage/' . $product->image) }}"
              alt="Image principale de {{ $product->name }}"
              class="w-full h-[400px] object-contain bg-white p-6"
            />
            <button
              onclick='openLightbox("{{ asset("storage/" . $product->image) }}")'
              class="absolute bottom-5 right-5 bg-white bg-opacity-90 p-3 rounded-full text-blue-600 shadow-md hover:bg-blue-50 transition"
              aria-label="Agrandir l'image principale"
            >
              <i class="fas fa-magnifying-glass-plus text-2xl"></i>
            </button>
          </div>

          <!-- Images secondaires -->
          @foreach ($product->images as $img)
          <div class="swiper-slide relative group">
            <img
              src="{{ asset('storage/' . $img->path) }}"
              alt="Image secondaire de {{ $product->name }}"
              class="w-full h-[400px] object-contain bg-white p-6"
            />
            <button
              onclick="openLightbox('{{ asset('storage/' . $img->path) }}')"
              class="absolute bottom-5 right-5 bg-white bg-opacity-90 p-3 rounded-full text-blue-600 shadow-md hover:bg-blue-50 transition"
              aria-label="Agrandir l'image secondaire"
            >
              <i class="fas fa-magnifying-glass-plus text-2xl"></i>
            </button>
          </div>
          @endforeach
        </div>

        <!-- Pagination & Navigation -->
        <div class="swiper-pagination mt-4"></div>
        <div class="swiper-button-prev text-gray-700 hover:text-blue-600"></div>
        <div class="swiper-button-next text-gray-700 hover:text-blue-600"></div>
      </div>
    </div>

    <!-- Infos produit -->
    <div class="flex flex-col justify-between">
      <div>
        {{-- Nom produit --}}
        <h1 class="text-4xl font-extrabold mb-3 text-gray-900">{{ $product->name }}</h1>

        {{-- Description juste en dessous --}}
        <p class="text-gray-700 leading-relaxed mb-8">{{ $product->description }}</p>



        {{-- Autres infos --}}
        <p class="text-gray-600 mb-2">
  <strong>Catégorie :</strong>
  {{ $product->category ? ucfirst($product->category->name) : 'Non défini' }}
</p>
        <p class="text-gray-600 mb-2"><strong>Marque :</strong> {{ $product->brand ?? 'Non définie' }}</p>
        <p class="text-3xl text-green-600 font-extrabold mb-4">{{ number_format($product->price, 2) }} Dh</p>

        <div class="text-sm text-gray-500 space-y-1">
          <p><strong>Stock :</strong> {{ $product->stock ?? 'Non spécifié' }}</p>
          <p><strong>Référence :</strong> {{ $product->reference ?? 'N/A' }}</p>
        </div>
      </div>
      {{-- Boutons côte à côte --}}
        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mb-8">
          <a href="{{ route('reviews.create', $product->id) }}"
            class="flex-1 text-center py-3 px-6 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
            Laisser un avis
          </a>

          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition">
              Passer à la commande
            </button>
          </form>
        </div>
    </div>
  </div>

  <!-- Bouton retour -->
  <div class="mt-12">
    <a href="{{ route('shop.index') }}" class="inline-flex items-center text-blue-600 hover:underline text-sm font-medium">
      <i class="fas fa-arrow-left mr-2"></i> Retour à la boutique
    </a>
  </div>

  {{-- Avis clients (optionnel, tu peux garder ou adapter) --}}
  <div class="mt-16">
    <h2 class="text-2xl font-bold mb-8 text-gray-900">Avis des clients</h2>
    @forelse ($product->reviews as $review)
    <div class="mb-6 p-5 border border-gray-200 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
      <div class="flex items-center mb-2 text-yellow-400 text-lg select-none">
        @for ($i = 1; $i <= 5; $i++)
        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
        @endfor
        <span class="ml-3 text-gray-600 font-medium text-sm select-text">par {{ $review->user->name ?? 'Client' }}</span>
      </div>
      <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
    </div>
    @empty
    <p class="text-gray-500 italic text-center">Aucun avis pour ce produit pour le moment.</p>
    @endforelse
  </div>
</div>

<!-- Lightbox (idem que précédemment) -->
<div
  id="lightbox"
  class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center"
  role="dialog"
  aria-modal="true"
  aria-label="Image agrandie"
>
  <div class="relative max-w-[90vw] max-h-[90vh]">
    <button
      onclick="closeLightbox()"
      class="absolute top-2 right-2 text-white text-4xl font-bold hover:text-red-500 transition"
      aria-label="Fermer la visionneuse"
    >
      &times;
    </button>
    <img
      id="lightbox-img"
      src=""
      alt="Zoom"
      class="rounded-xl shadow-xl max-w-full max-h-full object-contain"
    />
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  // Initialiser Swiper
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  // Ouvrir le lightbox
  function openLightbox(src) {
    const lightbox = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");
    img.src = src;
    lightbox.classList.remove("hidden");
  }

  // Fermer le lightbox
  function closeLightbox() {
    const lightbox = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");
    lightbox.classList.add("hidden");
    img.src = ""; // Réinitialiser l'image pour éviter les bugs de chargement
  }

  // Fermer avec touche Échap
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeLightbox();
    }
  });

  // Fermer en cliquant à l’extérieur de l’image
  document.addEventListener("click", function (e) {
    const lightbox = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");
    if (lightbox && !lightbox.classList.contains("hidden") && !img.contains(e.target) && !e.target.closest(".swiper-slide")) {
      closeLightbox();
    }
  });
</script>

@endsection
