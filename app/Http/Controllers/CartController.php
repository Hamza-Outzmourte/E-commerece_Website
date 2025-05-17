<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Ajouter un produit au panier
    public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "id" => $id,    // ajoute l'id ici si besoin
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Produit ajouté au panier !');
}

    // Supprimer un produit du panier
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier!');
    }

    // Mettre à jour la quantité d’un produit dans le panier
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $quantity = $request->input('quantity');
            if($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Panier mis à jour!');
    }
}

