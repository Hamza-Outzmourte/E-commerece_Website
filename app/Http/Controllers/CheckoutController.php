<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        // Traitement de la commande (validation, paiement, sauvegarde, etc.)
        // Pour l'exemple :
        return redirect()->route('checkout.index')->with('success', 'Commande validée avec succès !');
    }
}

