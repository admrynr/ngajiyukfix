<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Blog;
use App\Http\Models\Video;



class Comment extends Model
{
    protected $table ="comment";

    protected $fillable = [
    	'*'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public funtion videos()
    {
    	return $this->belongsTo(Video::class);
    }

	public funtion blogs()
    {
    	return $this->belongsTo(Blog::class);
    }    

}
