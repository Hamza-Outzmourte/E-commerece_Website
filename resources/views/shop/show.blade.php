<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image du produit -->
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg w-full max-w-md object-cover">
            </div>

            <!-- Infos du produit -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                <p class="text-gray-600 mb-2"><strong>Catégorie :</strong> {{ $product->category ?? 'Non défini' }}</p>

                <p class="text-xl text-green-600 font-semibold mb-4">{{ number_format($product->price, 2) }} Dh</p>

                <p class="text-gray-700 mb-6">{{ $product->description }}</p>

                <p class="text-sm text-gray-500 mb-4">
                    <strong>Stock :</strong> {{ $product->stock ?? 'Non spécifié' }}<br>
                    <strong>Référence :</strong> {{ $product->reference ?? 'N/A' }}
                </p>

                <!-- Formulaire d'ajout au panier -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>

        <!-- Lien retour -->
        <div class="mt-6">
            <a href="{{ route('shop.index') }}" class="text-blue-600 hover:underline">&larr; Retour à la boutique</a>
        </div>
    </div>

</body>
</html>

