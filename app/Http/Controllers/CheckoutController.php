<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderPlacedNotification;


class CheckoutController extends Controller
{
    public function index()
    {
        // Retourner la vue du formulaire de checkout
        return view('checkout.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'phone'   => 'required|string|max:255',
        'address' => 'required|string',
    ]);

    $cart = session('cart', []);
    $total = 0;

    if (empty($cart)) {
        return back()->with('error', 'Votre panier est vide.');
    }

    // Vérifier que chaque produit a assez de stock
    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        if (!$product || $product->stock < $item['quantity']) {
            return back()->with('error', "Stock insuffisant pour le produit : {$product->name}");
        }

        $total += $item['price'] * $item['quantity'];
    }

    // Créer la commande
    $order = Order::create([
        'user_id' => auth()->id(),
        'name'    => $request->name,
        'phone'   => $request->phone,
        'address' => $request->address,
        'status'  => 'pending',
        'total'   => $total,
    ]);

    // Ajouter les produits à la commande
    foreach ($cart as $item) {
        $product = Product::find($item['id']);

        // Créer la ligne dans order_items
        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
        ]);

        // Réduire le stock du produit
        $product->stock -= $item['quantity'];
        $product->save();
    }

    // Notifications
    $admin = User::where('is_admin', true)->first();
    if ($admin) {
        $admin->notify(new NewOrderNotification($order));
    }

    auth()->user()->notify(new OrderPlacedNotification($order));

    // 🎁 Ajouter les points fidélité (ex: 1 point / 10€)
    $earnedPoints = floor($total / 10);
    if ($earnedPoints > 0) {
        auth()->user()->points()->create([
    'points' => 10,                    // <== utilise 'points' et non 'value'
    'description' => 'Commande du ' . now()->format('d/m/Y'),  // renommer aussi 'reason' en 'description' si ta colonne est 'description'
]);
    }

    // Vider le panier
    session()->forget('cart');

    return redirect()->route('orders.thankyou')->with('success', 'Commande passée avec succès !');
}


    public function thankyou()
    {
        return view('checkout.thankyou');
    }

}



