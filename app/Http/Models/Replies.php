<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;


class Replies extends Model
{
    use SoftDeletes;

    protected $table = "replies";

    protected $fillable = [
        '*'];

    protected $dates = ['deleted_at'];

    //relationships
    public function commments(){
    	return $this->belongsTo(Comment::class);
    }
}
