<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Categories;
use App\Http\Models\ProductMedia;
use App\Http\Models\TransactionDetail;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        '*'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function product_media()
    {
        return $this->hasMany(ProductMedia::class);
    }
    public function transactiondetail()
    {
      return $this->hasMany(TransactionDetail::class);
    }
}
