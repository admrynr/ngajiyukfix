<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Models\CartDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $table = "cart";

    protected $fillable = [
        'user_id',
        'is_claim'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartdetail()
    {
        return $this->hasMany(CartDetail::class);
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
