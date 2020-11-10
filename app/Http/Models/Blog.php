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
        return $this->belongsTo(\App\Models\Categories::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
