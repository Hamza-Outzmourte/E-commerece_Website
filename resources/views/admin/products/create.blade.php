<!-- Ajout catégorie -->
<div>
    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
    <select name="category" id="category"
        class="block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <option value="">-- Choisir une catégorie --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                {{ ucfirst($cat) }}
            </option>
        @endforeach
    </select>
    @error('category')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Ajout marque -->
<div>
    <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
    <select name="brand" id="brand"
        class="block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <option value="">-- Choisir une marque --</option>
        @foreach($brands as $brand)
            <option value="{{ $brand }}" {{ old('brand') == $brand ? 'selected' : '' }}>
                {{ ucfirst($brand) }}
            </option>
        @endforeach
    </select>
    @error('brand')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
