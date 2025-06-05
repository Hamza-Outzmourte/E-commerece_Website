<?php
// app/Observers/StockObserver.php

namespace App\Observers;

use App\Models\Stock;

class StockObserver
{
    /**
     * Méthode appelée après une création ou mise à jour
     */
    public function saved(Stock $stock)
    {
        if ($stock->product) {
            $stock->product->stock = $stock->quantity;
            $stock->product->save();
        }
    }

    /**
     * Méthode appelée après suppression du stock
     */
    public function deleted(Stock $stock)
    {
        if ($stock->product) {
            $stock->product->stock = 0;
            $stock->product->save();
        }
    }
}
