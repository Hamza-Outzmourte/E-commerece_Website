<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
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
        return view('admin.products.create');
    }

    // Enregistrer un produit
    public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'image'       => 'nullable|image',
        'images.*'    => 'nullable|image', // images supplémentaires
        'category'    => 'nullable|string|max:255',
        'brand'       => 'nullable|string|max:255',
    ]);

    // Ajout éventuel d'un user_id si tu veux lier au user connecté
    $validated['user_id'] = auth()->id(); // (optionnel, si le produit appartient à un utilisateur)

    // Image principale
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Création du produit
    $product = Product::create($validated);

    // Images supplémentaires
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
        $product = Product::with('images', 'reviews.user')->findOrFail($id);
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
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:255',
            'brand'       => 'nullable|string|max:255',
            'image'       => 'nullable|image',
            'images.*'    => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->except('images');

        // Nouvelle image principale ?
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Nouvelles images supplémentaires
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
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
