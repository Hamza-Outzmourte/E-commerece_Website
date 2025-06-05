<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
    // Validation simplifiée (à adapter)
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
        'items' => 'required|array',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.qty' => 'required|integer|min:1',
    ]);

    DB::transaction(function () use ($request) {
        // Calcul du total en fonction des produits et quantités
        $total = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                throw new \Exception("Produit introuvable");
            }
            if ($product->stock < $item['qty']) {
                throw new \Exception("Stock insuffisant pour le produit {$product->name}");
            }
            $total += $product->price * $item['qty'];
        }

        // Création de la commande avec le total réel
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending',
            'total' => $total,
        ]);

        // Enregistrer les produits commandés et diminuer le stock
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $product->stock -= $item['qty'];
            $product->save();

            $order->products()->attach($product->id, ['quantity' => $item['qty']]);
        }

        // Notification à l'admin (si admin trouvé)
        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new NewOrderNotification($order));
        }

        // Notification à l'utilisateur connecté
        auth()->user()->notify(new OrderPlacedNotification($order));
    });

    return redirect()->route('orders.index')->with('success', 'Commande passée avec succès.');
}

}
