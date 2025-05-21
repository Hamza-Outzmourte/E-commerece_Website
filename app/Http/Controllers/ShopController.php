<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits (ou avec pagination)
        $products = Product::paginate(12);

        // Retourner la vue front avec les produits
        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
    
}
