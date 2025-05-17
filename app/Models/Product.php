<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Définis les colonnes que l’on peut remplir avec fill()
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image', // si tu ajoutes une image plus tard
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function brand()
{
    return $this->belongsTo(Brand::class);
}

}
