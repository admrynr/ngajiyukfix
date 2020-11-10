<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Cart;
use App\Http\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    protected $table = "cart_detail";

    protected $fillable = [
        'cart_id',
        'product_id',
        'qty'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
