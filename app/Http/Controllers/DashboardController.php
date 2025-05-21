<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupère le nombre total de produits et commandes de cet utilisateur
        $productCount = Product::where('id', $user->id)->count();
        $orderCount = Order::count();

        return view('dashboard', compact('user', 'productCount', 'orderCount'));
    }
    public function dashboard()
{
    $user = auth()->user();

    // Nombre de commandes (adapté à ta relation)
    $orderCount = Order::count();
    $notificationsCount = 0;

    // Nombre de notifications non lues (Laravel Notifications)
    // $notificationsCount = $user->unreadNotifications()->count();

    return view('dashboard', compact('user', 'orderCount', 'notificationsCount'));
}

}

