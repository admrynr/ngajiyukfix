<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Http\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    protected $table = "transaction_detail";

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'total_final_price',
        'total_base_price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
