<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Finaliser la commande</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 p-4 rounded text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nom complet</label>
                <input type="text" name="name" id="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-semibold mb-1">Téléphone</label>
                <input type="text" name="phone" id="phone" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block font-semibold mb-1">Adresse de livraison</label>
                <textarea name="address" id="address" rows="3" class="w-full border p-2 rounded" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Commander
            </button>
        </form>
    </div>
</body>
</html>
