<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Replies;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comment';

    protected $fillable = [
        '*'];

    

    protected $dates = ['deleted_at'];

    public function replies()
    {
    	return $this->hasMany(Replies::class);
    }
}
