<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    // Afficher la wishlist de l'utilisateur connecté
    public function index()
{
    $user = auth()->user();

    // Charger les éléments de la wishlist de l'utilisateur avec leurs produits
    $wishlistItems = $user->wishlist()->with('product')->get();

    return view('wishlist.index', compact('wishlistItems'));
}
public function add(Product $product)
    {
        $user = Auth::user();

        // Vérifie si le produit est déjà dans la wishlist
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('message', 'Produit déjà dans la wishlist.');
        }

        // Ajouter le produit à la wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('message', 'Produit ajouté à la wishlist.');
    }


    // Ajouter un produit à la wishlist
    public function store(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        // Vérifier que le produit existe
        $product = Product::findOrFail($productId);

        // Ajouter si pas déjà dans la wishlist
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté à votre wishlist.');
    }

    // Supprimer un produit de la wishlist
    public function destroy($id)
    {
        $user = Auth::user();

        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Produit retiré de votre wishlist.');
        }

        return redirect()->back()->with('error', 'Produit non trouvé dans la wishlist.');
    }
}
