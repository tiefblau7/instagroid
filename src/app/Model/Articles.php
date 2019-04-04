<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['image','comment', 'created_at', 'updated_at', 'published_at'];
}
