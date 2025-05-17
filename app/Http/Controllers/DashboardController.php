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

    $productCount = Product::count(); // ou Product::where('user_id', $user->id)->count();
    $orderCount = Order::where('user_id', $user->id)->count();

    return view('dashboard', [
        'user' => $user,
        'productCount' => $productCount,
        'orderCount' => $orderCount,
    ]);
}

}
