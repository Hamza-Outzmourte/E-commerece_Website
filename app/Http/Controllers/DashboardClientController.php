<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\Point;
use App\Models\SupportTicket;
use App\Models\ReturnRequest;
use App\Models\Review;

class DashboardClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Résumé commandes
        $orderCount = Order::where('user_id', $user->id)->count();
        $recentOrders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        $ordersByStatus = Order::selectRaw('status, count(*) as count')
            ->where('user_id', $user->id)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 2. Notifications
        $unreadNotificationsCount = $user->unreadNotifications()->count();
        $allNotifications = $user->notifications()->latest()->take(10)->get();

        // 3. Produits recommandés (exemple simple : derniers produits gaming)
        $recommendedProducts = Product::where('category', 'gaming')->latest()->take(5)->get();

        // 4. Statistiques perso
        $totalSpent = Order::where('user_id', $user->id)->sum('total'); // 'total' dans la table orders
        $topProducts = OrderItem::selectRaw('product_id, COUNT(*) as count')
            ->whereHas('order', fn($q) => $q->where('user_id', $user->id))
            ->groupBy('product_id')
            ->orderByDesc('count')
            ->with('product')
            ->take(5)
            ->get();

        // 5. Produits vus récemment (stockés en session par ex)
        $recentViewed = session('recent_viewed_products', []);
        $recentViewedProducts = Product::whereIn('id', $recentViewed)->get();

        // 6. Favoris / Wishlist
        $wishlist = Wishlist::where('user_id', $user->id)->with('product')->get();

        // 7. Coupons actifs

        // 8. Points fidélité
        $points = Point::where('user_id', $user->id)->sum('points');

        // 9. Tickets support client
        $supportTickets = SupportTicket::where('user_id', $user->id)->latest()->take(5)->get();

        // 10. Retours en cours
        $returnRequests = ReturnRequest::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'processing'])
            ->get();

        // 11. Avis postés
        $reviews = Review::where('user_id', $user->id)->latest()->take(5)->get();

        return view('dashboard', compact(
            'user',
            'orderCount',
            'recentOrders',
            'ordersByStatus',
            'unreadNotificationsCount',
            'allNotifications',
            'recommendedProducts',
            'totalSpent',
            'topProducts',
            'recentViewedProducts',
            'wishlist',
            'points',
            'supportTickets',
            'returnRequests',
            'reviews'
        ));
    }
}
