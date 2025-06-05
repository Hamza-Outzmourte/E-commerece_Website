<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    // Affiche la liste des avis
    public function index()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    // Affiche un avis spécifique
    public function show($id)
    {
        $review = Review::with('user', 'product')->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    // Supprime un avis
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Avis supprimé avec succès.');
    }

    // (optionnel) Valider un avis s’il y a un système de modération
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->approved = true;
        $review->save();

        return redirect()->back()->with('success', 'Avis approuvé.');
    }
}
