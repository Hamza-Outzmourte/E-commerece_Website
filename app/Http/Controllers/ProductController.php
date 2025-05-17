<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Liste tous les produits
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Formulaire création produit
    public function create()
    {
        return view('admin.products.create');
    }

    // Enregistrer un produit
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image',
            'category'    => 'nullable|string|max:255',
            'brand'       => 'nullable|string|max:255',
        ]);

        $productData = $request->all();

        // Gestion upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        Product::create($productData);

        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Afficher un produit
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Formulaire édition produit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Mettre à jour un produit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        $productData = $request->all();

        // Gestion upload image à la mise à jour
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        $product->update($productData);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
