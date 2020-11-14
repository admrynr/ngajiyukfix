<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Video extends Model
{
    protected $table = "Videos";

    protected $fillable = ["*"];

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

}
