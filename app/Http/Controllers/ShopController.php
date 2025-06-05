<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();
    if ($request->filled('brand')) {
    $query->where('id', $request->brand);
}
    // Filtre par catégorie via category_id (et pas 'category' texte)
    if ($request->filled('category')) {
        $query->where('id', $request->category);
    }

    // Filtre par type
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Filtre par plage de prix en DH
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Filtre par ordre de prix (asc ou desc)
    if ($request->filled('price') && in_array($request->price, ['asc', 'desc'])) {
        $query->orderBy('price', $request->price);
    }

    // Filtre par note moyenne (rating)
    if ($request->filled('rating')) {
        $minRating = (float) $request->rating;

        $query->whereHas('reviews', function ($q) use ($minRating) {
            $q->selectRaw('AVG(rating) as avg_rating')
              ->groupBy('product_id')
              ->havingRaw('AVG(rating) >= ?', [$minRating]);
        });
    }

    // Pagination avec conservation des filtres dans l'URL
    $products = $query->paginate(12)->withQueryString();

    // Récupérer les catégories depuis la table categories (pas depuis products)
    $categories = Category::all();
    $brands = Brand::all(); // Assure-toi que tu as un modèle Brand et une table brands


    // Récupérer les types depuis les produits (distinct)
    $types = Product::select('type')->distinct()->pluck('type');

    return view('shop.index', compact('products', 'categories', 'types', 'brands'));

}





    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }

}
