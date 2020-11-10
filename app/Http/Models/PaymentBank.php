<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentBank extends Model
{
    protected $table = "payment_bank";

    protected $fillable = [
        '*'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
