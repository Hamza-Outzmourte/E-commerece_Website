<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function index()
{
    // Statistiques principales
    $productCount = Product::count();
    $orderCount = Order::count();

    // Notifications non lues pour l'utilisateur connecté
    $notificationsCount = auth()->user()->unreadNotifications()->count();

    // Début de la période (12 derniers mois)
    $startDate = Carbon::now()->subMonths(11)->startOfMonth();

    // Commandes par mois
    $ordersData = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total_orders')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Revenus par mois (attention : ici on utilise `total` pas `total_amount`)
    $revenueData = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(total) as total_revenue')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Construire les labels et valeurs pour les graphiques
    $labels = [];
    $values = [];
    $revenueValues = [];

    for ($i = 0; $i < 12; $i++) {
        $month = $startDate->copy()->addMonths($i)->format('Y-m');
        $labels[] = $startDate->copy()->addMonths($i)->format('M Y');

        $order = $ordersData->firstWhere('month', $month);
        $revenue = $revenueData->firstWhere('month', $month);

        $values[] = $order ? $order->total_orders : 0;
        $revenueValues[] = $revenue ? $revenue->total_revenue : 0;
    }

    return view('admin.dashboard', [
        'productCount' => $productCount,
        'orderCount' => $orderCount,
        'notificationsCount' => $notificationsCount,
        'labels' => $labels,
        'values' => $values,
        'revenueValues' => $revenueValues,
    ]);
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
public function commandesParMois()
{
    $data = DB::table('orders')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return view('admin.dashboard.index', [
        'labels' => $data->pluck('month'),
        'values' => $data->pluck('total'),
    ]);
}
public function revenuParMois()
{
    $data = DB::table('orders')
        ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return view('admin.dashboard.index', [
        'labels' => $data->pluck('month'),
        'values' => $data->pluck('revenue'),
    ]);
}


}

