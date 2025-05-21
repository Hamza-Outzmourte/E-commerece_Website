<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $product->name }} | Détails du produit</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>
<body class="bg-gray-50 text-gray-800">

  <div class="max-w-7xl mx-auto px-6 py-10">
    <!-- Produit -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white p-6 rounded-3xl shadow-md">

      <!-- Galerie Swiper -->
      <div class="space-y-4">
        <div class="swiper mySwiper rounded-xl overflow-hidden shadow-md">
          <div class="swiper-wrapper">
            <!-- Image principale -->
            <div class="swiper-slide relative group">
              <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-[400px] object-contain bg-white p-4" alt="Image principale">
              <button onclick='openLightbox("{{ asset("storage/" . $product->image) }}")' class="absolute bottom-4 right-4  px-4 py-2 rounded-md text-sm text-blue-600 shadow-md hover:bg-blue-50">
    <i class="fas fa-magnifying-glass-plus text-gray-600 text-xl hover:text-blue-600 cursor-pointer"></i>
</button>

            </div>
            <!-- Images secondaires -->
            @foreach ($product->images as $img)
              <div class="swiper-slide relative group">
                <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-[400px] object-contain bg-white p-4" alt="Image secondaire">
                <button onclick="openLightbox('{{ asset('storage/' . $img->path) }}')" class="absolute bottom-4 right-4  px-4 py-2 rounded-md text-sm text-blue-600 shadow-md hover:bg-blue-50">
                  <i class="fas fa-magnifying-glass-plus text-gray-600 text-xl hover:text-blue-600 cursor-pointer"></i>

                </button>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination mt-2"></div>
          <div class="swiper-button-prev text-gray-700"></div>
          <div class="swiper-button-next text-gray-700"></div>
        </div>
      </div>

      <!-- Infos produit -->
      <div class="flex flex-col justify-between">
        <div>
          <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
          <p class="text-gray-600 mb-2"><strong>Catégorie :</strong> {{ $product->category ?? 'Non défini' }}</p>
          <p class="text-gray-600 mb-2"><strong>Marque :</strong> {{ $product->brand ?? 'Non définie' }}</p>

          <p class="text-2xl text-green-600 font-bold mb-6">{{ number_format($product->price, 2) }} Dh</p>

          <p class="text-gray-700 leading-relaxed mb-6">{{ $product->description }}</p>

          <div class="text-sm text-gray-500 mb-6">
            <p><strong>Stock :</strong> {{ $product->stock ?? 'Non spécifié' }}</p>
            <p><strong>Référence :</strong> {{ $product->reference ?? 'N/A' }}</p>
          </div>
        </div>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
          @csrf
          <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-sm transition">
            Ajouter au panier
          </button>
        </form>
      </div>
    </div>

    <!-- Bouton retour -->
    <div class="mt-8">
      <a href="{{ route('shop.index') }}" class="inline-flex items-center text-blue-600 hover:underline text-sm">
        &larr; Retour à la boutique
      </a>
    </div>

    <!-- Avis -->
    <div class="mt-14">
      <h2 class="text-2xl font-bold mb-6">Avis des clients</h2>

      @forelse ($product->reviews as $review)
        <div class="mb-4 p-4 border border-gray-200 rounded-xl bg-white shadow-sm">
          <div class="flex items-center mb-1 text-yellow-400 text-sm">
            @for ($i = 1; $i <= 5; $i++)
              <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
            @endfor
            <span class="ml-2 text-gray-600">par {{ $review->user->name ?? 'Client' }}</span>
          </div>
          <p class="text-gray-700">{{ $review->comment }}</p>
        </div>
      @empty
        <p class="text-gray-500 italic">Aucun avis pour ce produit pour le moment.</p>
      @endforelse
    </div>
  </div>

  <!-- Lightbox Agrandissement -->
  <div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center">
    <div class="relative">
      <button onclick="closeLightbox()" class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-red-400 transition">
        &times;
      </button>
      <img id="lightbox-img" src="" alt="Zoom" class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-xl">
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script>
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

    function openLightbox(src) {
      document.getElementById('lightbox-img').src = src;
      document.getElementById('lightbox').classList.remove('hidden');
    }

    function closeLightbox() {
      document.getElementById('lightbox').classList.add('hidden');
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === "Escape") closeLightbox();
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" integrity="sha512-1M09fP6Y6L7psEmEK1VXv9nMtkYzR0tA60FQdJADrBQIxDXOpnENb4fG/0FqFbBtvCQHtKmF9bAlD/5b9FLO8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
