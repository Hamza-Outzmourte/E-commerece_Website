<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Liste des produits
    public function index()
    {
        $products = Product::with('images')->get();

        return view('admin.products.index', compact('products'));
    }

    // Formulaire de création
    public function create()
{
    $categories = Category::all();
    $brands = Brand::all();

    return view('admin.products.create', compact('categories', 'brands'));
}


    // Enregistrer un produit




public function store(Request $request)
{
    $validated = $request->validate([
        'name'         => 'required|string|max:255',
        'description'  => 'required|string',
        'price'        => 'required|numeric|min:0',
        'stock'        => 'required|integer|min:0',
        'image'        => 'nullable|image|max:2048',
        'images.*'     => 'nullable|image|max:2048',
        'category_id'  => 'required|exists:categories,id',
        'brand_id'     => 'required|exists:brands,id',
        'type'         => ['required', Rule::in(['clavier', 'souris', 'écran'])],
    ]);

    $validated['user_id'] = auth()->id();

    // Gérer l'image principale
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Créer le produit
    $product = Product::create($validated);

    // Gérer les images supplémentaires
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
            ]);
        }
    }

    return redirect()->route('admin.products.index')
                     ->with('success', 'Produit ajouté avec succès.');
}




    // Afficher un produit côté boutique
    public function show($id)
{
    $product = Product::with(['brand', 'category', 'images', 'reviews.user'])->findOrFail($id);

    return view('shop.show', compact('product'));
}


    // Formulaire d'édition
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Mettre à jour un produit


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'category'    => 'nullable|string|max:255',
        'brand'       => 'nullable|string|max:255',
        'image'       => 'nullable|image|max:2048',
        'images.*'    => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'type'        => ['required', Rule::in(['clavier', 'souris', 'écran'])],  // validation type
    ]);

    $product = Product::findOrFail($id);

    // Gestion nouvelle image principale
    if ($request->hasFile('image')) {
        // Supprimer ancienne image si existe
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Mettre à jour le produit avec les données validées
    $product->update($validated);

    // Gestion images supplémentaires
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
            ]);
        }
    }

    return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
}


    // Supprimer un produit
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Supprimer l'image principale
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Supprimer les images secondaires
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
   public function search(Request $request)
{
    $query = $request->input('q');

    $products = Product::query()
        ->where('name', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->latest()
        ->paginate(12);

    return view('shop.search-results', compact('products', 'query'));
}

}
