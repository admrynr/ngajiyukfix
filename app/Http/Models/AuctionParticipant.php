<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Http\Models\Auction;

class AuctionParticipant extends Model
{
  protected $table = 'auction_participant';

  protected $fillable = [
      'auction_id',
      'user_id',
      'bid'
  ];

  use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function auction()
  {
      return $this->belongsTo(Auction::class);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
