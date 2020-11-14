<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Product;
use App\Http\Models\Video;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name', 'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

}
