<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    // Affiche tous les produits
    public function index()
{
    $results = Product::all();
    $query = null; // Pour éviter l'erreur dans la vue
    return view('search', compact('results', 'query'));
}


    // Recherche par mot-clé
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Product::where('name', 'like', "%{$query}%")->get();

        return view('search', compact('results', 'query'));
    }
}

