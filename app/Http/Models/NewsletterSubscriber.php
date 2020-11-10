<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = "newsletter_subscriber";

    protected $fillable = [
        'email, is_active'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
