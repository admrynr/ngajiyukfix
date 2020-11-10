<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use SoftDeletes;
    
    protected $table = 'seo';

    protected $fillable = [
        '*'];

    protected $dates = ['deleted_at'];
    
    //relation
}
