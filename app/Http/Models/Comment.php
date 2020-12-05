<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comment';

    protected $fillable = [
        '*'];

    

    protected $dates = ['deleted_at'];
}
