<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Categories;


class Video extends Model
{
    protected $table = "Videos";

    protected $fillable = ["*"];

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function categories()
    {
    	return $this->belongsTo(Categories::class, 'id_category');
    }

}
