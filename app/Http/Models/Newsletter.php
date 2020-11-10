<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = "newsletter";

    protected $fillable = [
        'title, description'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
