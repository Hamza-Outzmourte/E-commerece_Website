<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PaymentConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirmPayment(Request $request)
    {
        // Validation basique
        $request->validate([
            'total' => 'required|numeric',
        ]);

        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Création de la commande
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $request->total,
            'status' => 'paid',
        ]);

        // Envoi du mail de confirmation
        Mail::to($user->email)->send(new PaymentConfirmationMail($order));

        return response()->json(['message' => 'Commande enregistrée et email envoyé.']);
    }
}
