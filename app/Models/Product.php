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
        'image',
        'category',
        'brand',
        'type' // 'type' est un champ optionnel, tu peux l'enlever si tu n'en as pas besoin

        // si tu ajoutes une image plus tard
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id');
}






public function reviewsCount()
{
    return $this->reviews()->count();
}
public function images()
{
    return $this->hasMany(ProductImage::class);
}
// app/Models/Product.php

public function stock()
{
    return $this->hasOne(Stock::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}

public function averageRating()
{
    return $this->reviews()->avg('rating') ?? 0;
}
}
