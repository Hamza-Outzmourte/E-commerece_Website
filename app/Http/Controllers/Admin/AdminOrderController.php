<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        // Initialisation de la requête avec la relation 'user'
        $query = Order::with('user');

        // Filtrage par statut si présent dans la requête
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtrage par date de création si les deux dates sont présentes
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [
                $request->date_from . ' 00:00:00',
                $request->date_to . ' 23:59:59'
            ]);
        }

        // Récupère les commandes triées par date décroissante avec pagination
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        // Retourne la vue avec les données
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Récupérer la commande avec les détails utilisateur et autres relations si besoin
        $order = Order::with('user')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en_attente,en_cours,expediee,annulee'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    public function invoice($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

        return $pdf->download('facture_commande_' . $order->id . '.pdf');
    }

    public function statistics()
    {
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.orders.statistics', compact('monthlySales', 'monthlyOrders'));
    }

    public function create()
    {
        // Ici, tu peux préparer des données nécessaires pour créer une commande,
        // par exemple une liste de produits, utilisateurs, etc.

        return view('admin.orders.create');  // Crée cette vue pour le formulaire
    }
}
