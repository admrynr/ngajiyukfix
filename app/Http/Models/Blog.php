<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    
    protected $table = 'blog';

    protected $fillable = [
        '*'];

    

    protected $dates = ['deleted_at'];
    
    //relation
    public function categories()
    {
        return $this->belongsTo(\App\Http\Models\Categories::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
