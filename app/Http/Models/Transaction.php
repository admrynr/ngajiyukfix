<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Models\TransactionDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $table = "transaction";

    protected $fillable = [
        'user_id',
        'invoice_number',
        'shipping_type',
        'estimate_date',
        'address',
        'province_id',
        'city_id',
        'total_weight',
        'payment_type',
        'midtrans_payment_type',
        'midtrans_transaction_id',
        'midtrans_pdf_url',
        'midtrans_finish_redirect_url',
        'payment_account',
        'payment_number',
        'total_base_price',
        'total_final_price',
        'tax',
        'shipping_price',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactiondetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
