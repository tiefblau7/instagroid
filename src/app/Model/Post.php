<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['image','comment', 'created_at', 'updated_at','github_id'];
}
