<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Product;

class ProductMedia extends Model
{
    protected $table = 'products_media';

    protected $fillable = [
        '*'
    ];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
