<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Categories;
use App\Http\Models\Product;
use App\Http\Models\AuctinParticipant;
use App\User;

class Auction extends Model
{
    protected $table = 'auction';

    protected $fillable = [
        'product_id',
        'auction_type',
        'max_price',
        'min_price',
        'scale',
        'fixed_price',
        'bid_start',
        'bid_end',
        'winner_id',
        'winner_bid'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function winner()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function participant()
    {
        return $this->hasMany(AuctionParticipant::class);
    }
}
