<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    // Autoriser l'assignation de ces colonnes
    protected $fillable = [
        'product_id',
        'path',
    ];

    // Relation vers le produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

