<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

    // Enregistrer l'avis dans la base de données
    Review::create([
        'user_id' => auth()->id(), // l'utilisateur connecté
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Merci pour votre avis !');
}
}
