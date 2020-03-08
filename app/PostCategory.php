<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $primaryKey = 'id';

    public function posts() {
    	return $this->belongsToMany(Post::class);
    }

    public $timestamps = true;
}
