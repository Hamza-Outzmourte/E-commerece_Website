<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmationMail;

class PaymentController extends Controller
{
    public function confirm(Request $request)
    {
        $user = auth()->user();

        $products = $request->input('products'); // Exemple : [ ['id' => 1, 'quantity' => 2], ... ]
        $total = 0;

        // Créer la commande
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'paid',
        ]);

        foreach ($products as $p) {
            $product = Product::findOrFail($p['id']);
            $quantity = $p['quantity'];
            $linePrice = $product->price * $quantity;
            $total += $linePrice;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        $order->update(['total' => $total]);

        // Envoi de l'e-mail
        Mail::to($user->email)->send(new PaymentConfirmationMail($order));

        return response()->json(['message' => 'Commande enregistrée et email envoyé.']);
    }
}

