<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderPlacedNotification;

class OrderController extends Controller
{
    public function index()
    {
        // Par exemple récupérer toutes les commandes de l'utilisateur connecté
        $orders = Order::where('user_id', auth()->id())->get();

        // Retourner une vue avec les commandes
        return view('orders.index', compact('orders'));
    }
    public function store(Request $request)
{
    $order = Order::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'status' => 'pending',
        'total' => 100, // à remplacer par le vrai total du panier
    ]);

    // ✅ Notifier l'admin s'il existe
    $admin = User::where('is_admin', true)->first();
    if ($admin) {
        $admin->notify(new NewOrderNotification($order));
    }

    // ✅ Notifier le client (l'utilisateur connecté)
    dd(auth()->user()->notify(new OrderPlacedNotification($order)));

    // ❌ Ne pas marquer les notifications comme lues juste après les avoir envoyées
    // Cette ligne est à retirer :
    // auth()->user()->unreadNotifications->markAsRead();

    return redirect()->route('orders.index')->with('success', 'Commande passée avec succès.');
}

}

