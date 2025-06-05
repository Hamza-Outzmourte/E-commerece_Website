<?php

namespace App\Http\Controllers;

use App\Models\ReturnRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnRequestController extends Controller
{
    public function index()
    {
        // Afficher les demandes de retour de l'utilisateur connecté
        $returnRequests = ReturnRequest::where('user_id', Auth::id())->latest()->get();
        return view('return_requests.index', compact('returnRequests'));
    }

    public function create()
    {
        // Optionnel : afficher un formulaire avec les commandes valides pour retour
        $orders = Order::where('user_id', Auth::id())->where('status', 'completed')->get();
        return view('return_requests.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'reason'   => 'required|string|max:255',
            'details'  => 'nullable|string',
        ]);

        // Vérifier que la commande appartient bien à l'utilisateur
        $order = Order::where('id', $request->order_id)->where('user_id', Auth::id())->firstOrFail();

        ReturnRequest::create([
            'order_id' => $order->id,
            'user_id'  => Auth::id(),
            'reason'   => $request->reason,
            'details'  => $request->details,
            'status'   => 'pending',
        ]);

        return redirect()->route('return_requests.index')->with('success', 'Demande de retour envoyée avec succès.');
    }
}

