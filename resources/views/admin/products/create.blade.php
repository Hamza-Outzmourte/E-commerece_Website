@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-6 py-4">
            <h1 class="text-2xl font-bold">Ajouter un nouveau produit</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 text-red-700 dark:text-red-300 p-4 mb-6">
                <p class="font-semibold mb-2">Des erreurs ont été trouvées :</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Nom du produit -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom du produit</label>
                <input type="text" name="name" id="name"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-150"
                       required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="5"
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-150"
                          required></textarea>
            </div>

            <!-- Prix -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix (MAD)</label>
                <input type="number" name="price" id="price" step="0.01"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-150"
                       required>
            </div>

            <!-- Stock -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock disponible</label>
                <input type="number" name="stock" id="stock" min="0"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-150"
                       required>
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                        required>
                    <option value="">-- Choisir un type --</option>
                    <option value="clavier">Clavier</option>
                    <option value="souris">Souris</option>
                    <option value="écran">Écran</option>
                </select>
            </div>

            <!-- Catégorie -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catégorie</label>
                <select name="category_id" id="category_id"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                        required>
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Marque -->
            <div class="mb-4">
  <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
    Marque
  </label>
  <select
    name="brand_id"
    id="brand_id"
    required
    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
  >
    <option value="">-- Choisir une marque --</option>
    @foreach ($brands as $brand)
      <option value="{{ $brand->id }}">{{ $brand->name }}</option>
    @endforeach
  </select>
</div>


            <!-- Image principale -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image principale</label>
                <input type="file" name="image" id="image"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none transition duration-150"
                    accept="image/*" required>
            </div>

            <!-- Images supplémentaires -->
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Images supplémentaires</label>
                <input type="file" name="images[]" id="images"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-500 file:text-white hover:file:bg-indigo-600 focus:outline-none transition duration-150"
                    accept="image/*" multiple>
            </div>

            <!-- Bouton Soumettre -->
            <div class="pt-4 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Ajouter le produit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
