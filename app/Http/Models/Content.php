<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $table = "content";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        '*'
    ];

}
