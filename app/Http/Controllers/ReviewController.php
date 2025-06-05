<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

public function store(Request $request, Product $product)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    $review = $product->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // Debug temporaire
    dd($review);

    return redirect()->route('shop.show', $product->id)->with('success', 'Votre avis a été ajouté.');
}

public function create(Product $product)
{
    return view('reviews.create', compact('product'));
}
public function show(Product $product)
{
    $product->load('reviews');

    return view('shop.show', compact('product'));
}

}
