<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Stock extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // app/Models/Stock.php

public function product()
{
    return $this->belongsTo(Product::class);
}



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

