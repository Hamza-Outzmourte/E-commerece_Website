<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    // Afficher les points de l'utilisateur connecté
    public function index()
    {
        $user = Auth::user();
        $points = $user->points()->orderBy('created_at', 'desc')->get();
        $totalPoints = $user->totalPoints();

        return view('points.index', compact('points', 'totalPoints'));
    }

    // Ajouter des points (exemple pour admin ou système)
    public function addPoints(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Point::create([
            'user_id' => $request->user_id,
            'points' => $request->points,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Points ajoutés avec succès.');
    }
}

