<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StockController extends Controller
{
    use AuthorizesRequests;
    public function index()
{
    $stocks = Stock::with('product')->get();
    return view('admin.stock.index', compact('stocks'));
}
public function updateStock(Request $request, $productId)
{
    // Valide la quantité de stock reçue
    $request->validate([
        'quantity' => 'required|integer|min:0',
    ]);

    // Met à jour ou crée la ligne dans la table stock
    $stock = Stock::updateOrCreate(
        ['product_id' => $productId],
        ['quantity' => $request->quantity]
    );

    // Met à jour le stock dans la table products
    $product = Product::findOrFail($productId);
    $product->stock = $request->quantity;
    $product->save();

    return redirect()->back()->with('success', 'Stock mis à jour.');
}
    public function update(Request $request, Stock $stock)
{
    $request->validate([
        'quantity' => 'required|integer|min:0',
    ]);

    $stock->update(['quantity' => $request->quantity]);

    // Synchroniser aussi la colonne stock dans products (optionnel)
    $stock->product->update(['stock' => $request->quantity]);

    return redirect()->route('admin.stock.index')->with('success', 'Stock mis à jour.');
}


    public function syncStocks()
{
    $products = Product::all();

    foreach ($products as $product) {
        Stock::updateOrCreate(
    ['product_id' => $product->id],
    [
        'quantity' => $product->stock,
        'user_id' => auth()->id() // Toujours fournir user_id car c'est requis en base
    ]
);


    }

    return redirect()->route('admin.stock.index')->with('success', 'Stocks synchronisés.');

}
public function addStockQuantity($productId, $quantityToAdd)
{
    // Cherche le stock existant du produit
    $stock = Stock::where('product_id', $productId)->first();

    if ($stock) {
        // Le stock existe, on ajoute la quantité
        $stock->quantity += $quantityToAdd;
        $stock->save();
    } else {
        // Pas de stock pour ce produit, on crée une nouvelle ligne
        Stock::create([
            'product_id' => $productId,
            'quantity' => $quantityToAdd,
            'user_id' => auth()->id(),
        ]);
    }
}

    public function create()
{
    $products = Product::all();
    return view('admin.stock.create', compact('products'));
}
public function show(Stock $stock)
{
    // Par exemple, rediriger vers index ou afficher un détail
    return redirect()->route('admin.stock.index');
}


   public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:0',
    ]);

    // Chercher le stock existant pour ce produit
    $stock = Stock::where('product_id', $request->product_id)->first();

    if ($stock) {
        // Si existe, additionner la quantité
        $stock->quantity += $request->quantity;
        $stock->user_id = auth()->id(); // mettre à jour l'user_id si besoin
        $stock->save();
    } else {
        // Sinon créer un nouveau record
        Stock::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    return redirect()->route('admin.stock.index')->with('success', 'Stock mis à jour avec la nouvelle quantité.');
}



    public function edit(Stock $stock)
    {
        $this->authorize('update', $stock); // si tu utilises les policies
        $products = Product::all();
        return view('admin.stock.edit', compact('stock', 'products'));
    }

        public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('admin.stock.index')->with('success', 'Stock supprimé.');
    }
}

