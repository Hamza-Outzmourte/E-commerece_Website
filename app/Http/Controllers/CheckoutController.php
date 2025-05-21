<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
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

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'name'    => $request->name,
        'phone'   => $request->phone,
        'address' => $request->address,
        'status'  => 'pending',
        'total'   => $total,
    ]);

    // ✅ Envoyer les notifications
    $admin = User::where('is_admin', true)->first();
    if ($admin) {
        $admin->notify(new NewOrderNotification($order));
    }

    auth()->user()->notify(new OrderPlacedNotification($order));

    // Vider le panier
    session()->forget('cart');

    return redirect()->route('orders.thankyou')->with('success', 'Commande passée avec succès !');
}
    public function thankyou()
    {
        return view('checkout.thankyou');
    }
}



