<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Define the Relationship between Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
